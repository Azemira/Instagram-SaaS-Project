<?php

namespace App\Console\Commands;

use App\Jobs\ProcessFollower;
use App\Models\User;
use App\Notifications\FollowerLog;
use Illuminate\Console\Command;
use InstagramAPI\Instagram;
use InstagramAPI\Signatures;

class GetFollower extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * @var type (followers | following)
     */
    protected $signature = 'pilot:get-follower {type=followers}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get followers / following';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $follow_type = ($this->argument('type') == 'following'
            ? config('pilot.FOLLOWER_TYPE_FOLLOWING')
            : config('pilot.FOLLOWER_TYPE_FOLLOWERS')
        );

        $users = User::with(['accounts' => function ($q) {
            $q->withoutGlobalScopes();
        }])->get();

        if ($users->count()) {

            foreach ($users as $user) {

                if (!$user->subscribed('main') && !$user->onTrial() && !$user->can('admin')) {
                    continue;
                }

                if ($user->accounts->count()) {

                    if ($follow_type == config('pilot.FOLLOWER_TYPE_FOLLOWERS')) {
                        $sorted = $user->accounts->sortBy('followers_sync_at');
                    } else {
                        $sorted = $user->accounts->sortBy('following_sync_at');
                    }

                    $user->accounts = $sorted->values();

                    foreach ($user->accounts as $account) {

                        $instagram = new Instagram(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

                        if ($account->proxy) {
                            $instagram->setProxy($account->proxy->server);
                        }

                        try {

                            $this->info('Try to login with account: ' . $account->username);

                            $loginResponse = $instagram->login($account->username, $account->password);

                            if (is_null($loginResponse)) {

                                $this->info('Logged in successfully');

                                try {

                                    $__user = $instagram->people->getSelfInfo()->getUser();

                                    $account->posts_count     = $__user->getMediaCount();
                                    $account->followers_count = $__user->getFollowerCount();
                                    $account->following_count = $__user->getFollowingCount();

                                } catch (\Exception $e) {
                                    $this->error('Something went wrong: ' . $e->getMessage());
                                }

                                try {

                                    $rankToken    = Signatures::generateUUID();
                                    $maxId        = null;
                                    $page         = 1;
                                    $account_list = collect();

                                    do {

                                        $this->info('Sleeping for a while..');

                                        // Simulate real human behavior
                                        sleep(rand(config('pilot.SLEEP_MIN'), config('pilot.SLEEP_MAX')));

                                        $this->info('Gathering audience on page: ' . $page);

                                        try {
                                            if ($follow_type == config('pilot.FOLLOWER_TYPE_FOLLOWERS')) {
                                                $audience = $instagram->people->getSelfFollowers($rankToken, null, $maxId);
                                            } else {
                                                $audience = $instagram->people->getSelfFollowing($rankToken, null, $maxId);
                                            }
                                        } catch (\Exception $e) {
                                            $this->error('Something went wrong: ' . $e->getMessage());
                                        }

                                        foreach ($audience->getUsers() as $__user) {

                                            $account_list->push([
                                                'pk'       => $__user->getPk(),
                                                'username' => $__user->getUsername(),
                                            ]);
                                        }

                                        // Pagination
                                        $maxId = $audience->getNextMaxId();
                                        $page++;

                                    } while ($maxId !== null);

                                    /**
                                     * Process gathered accounts
                                     *
                                     * Detect new followers / following
                                     * Which are not in `followers` table
                                     */
                                    foreach ($account_list as $check_account) {

                                        $follow = $account->followers()
                                            ->firstOrCreate(
                                                [
                                                    'pk'   => $check_account['pk'],
                                                    'type' => $follow_type,
                                                ],
                                                [
                                                    'username' => $check_account['username'],
                                                ]
                                            );

                                        /**
                                         * New follower
                                         * Do nothing on first sync
                                         */
                                        if ($follow->wasRecentlyCreated) {

                                            if ($follow_type == config('pilot.FOLLOWER_TYPE_FOLLOWERS')) {
                                                $sync_at = $account->followers_sync_at;
                                            } else {
                                                $sync_at = $account->following_sync_at;
                                            }

                                            if ($sync_at) {

                                                $options = [
                                                    'account'    => $account->username,
                                                    'account_id' => $account->id,
                                                    'action'     => ($follow_type == config('pilot.FOLLOWER_TYPE_FOLLOWING')
                                                        ? config('pilot.ACTION_FOLLOWING_FOLLOW')
                                                        : config('pilot.ACTION_FOLLOWERS_FOLLOW')),
                                                    'pk'         => $follow->pk,
                                                    'username'   => $follow->username,
                                                ];

                                                ProcessFollower::dispatch($options)
                                                    ->delay(now()->addSeconds(rand(config('pilot.SLEEP_MIN'), config('pilot.SLEEP_MAX'))))
                                                    ->onQueue('autopilot');

                                                $user->notify(new FollowerLog($options));

                                                $this->line('New follow: ' . $follow->username);
                                            }
                                        }
                                    }

                                    /**
                                     * Detect un-followers
                                     * Which are in `followers` table but not in $account_list
                                     */
                                    $un_folowers = $account->followers()
                                        ->where('type', $follow_type)
                                        ->whereNotIn('pk', $account_list->pluck('pk'))
                                        ->get();

                                    foreach ($un_folowers as $unfollow) {

                                        $options = [
                                            'account'    => $account->username,
                                            'account_id' => $account->id,
                                            'action'     => ($follow_type == config('pilot.FOLLOWER_TYPE_FOLLOWING')
                                                ? config('pilot.ACTION_FOLLOWING_UN_FOLLOW')
                                                : config('pilot.ACTION_FOLLOWERS_UN_FOLLOW')),
                                            'pk'         => $unfollow->pk,
                                            'username'   => $unfollow->username,
                                        ];

                                        ProcessFollower::dispatch($options)
                                            ->delay(now()->addSeconds(rand(config('pilot.SLEEP_MIN'), config('pilot.SLEEP_MAX'))))
                                            ->onQueue('autopilot');

                                        $user->notify(new FollowerLog($options));

                                        $unfollow->delete();

                                        $this->line('New un-follow: ' . $unfollow->username);
                                    }

                                    if ($follow_type == config('pilot.FOLLOWER_TYPE_FOLLOWERS')) {
                                        $account->followers_sync_at = now();
                                    } else {
                                        $account->following_sync_at = now();
                                    }

                                    $account->save();

                                } catch (\Exception $e) {
                                    $this->error('Can\'t generate UUID: ' . $e->getMessage());
                                }
                            } else {
                                $this->error('Can\'t login account: ' . $account->username);
                            }

                        } catch (\Exception $e) {
                            $this->error('Something went wrong: ' . $e->getMessage());
                        }

                        $this->info('Sleeping for a while..');

                        // Simulate real human behavior
                        sleep(rand(config('pilot.SLEEP_MIN'), config('pilot.SLEEP_MAX')));
                    }
                } else {
                    $this->info('No accounts found for user: ' . $user->email);
                }
            }
        } else {
            $this->info('No users found');
        }
    }
}
