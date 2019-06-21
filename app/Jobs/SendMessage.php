<?php

namespace App\Jobs;

use App\Models\Account;
use App\Models\MessageLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use InstagramAPI\Constants;
use InstagramAPI\Instagram;
use InstagramAPI\Media\Photo\InstagramPhoto;
use InstagramAPI\Media\Video\InstagramVideo;
use InstagramAPI\Utils;

class SendMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries   = 3; // The number of times the job may be attempted.
    public $timeout = 120; // If meesage don't sent in 120 seconds - reject
    protected $account_id;
    protected $pk;
    protected $thread_id;
    protected $recipient;
    protected $username;
    protected $message_type;
    protected $params;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($options = [])
    {
        if (isset($options['params']['message'])) {

            if (is_array($options['username'])) {
                $replace = '@' . join(', @', $options['username']);
            } else {
                $replace = '@' . $options['username'];
            }

            $options['params']['message'] = str_replace('@username', $replace, $options['params']['message']);
        }

        $this->account_id   = $options['account_id'];
        $this->pk           = $options['pk'];
        $this->thread_id    = $options['thread_id'];
        $this->username     = $options['username'];
        $this->message_type = $options['message_type'];
        $this->params       = $options['params'];

        // Lookup for matching account
        $account = Account::withoutGlobalScopes()->find($this->account_id);

        // Case 1: Provided only thread_id and users as array
        // Case 2: Provided only username and NO pk (from user's list)
        // Case 3: Provided both username & pk (autopilot)

        // Case 1
        if ($this->thread_id != null) {

            $this->recipient = [
                'thread' => $this->thread_id,
            ];

        } else {

            // Case 2
            if (is_null($this->pk)) {

                // Create instance
                $instagram = new Instagram(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

                // Set proxy if exists
                if ($account->proxy) {
                    $instagram->setProxy($account->proxy->server);
                }

                // Login to Instagram
                try {

                    $instagram->login($account->username, $account->password);

                } catch (\Exception $e) {

                    Log::error('Something went wrong: ' . $e->getMessage());
                }

                // Get user's pk
                try {

                    $this->pk = $instagram->people->getUserIdForName($this->username);

                    sleep(rand(config('pilot.SLEEP_MIN'), config('pilot.SLEEP_MAX')));

                } catch (\Exception $e) {

                    Log::error('Something went wrong: ' . $e->getMessage());
                }

            }

            $this->recipient = [
                'users' => [
                    $this->pk,
                ],
            ];
        }

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Set logger
        $log = MessageLog::withoutGlobalScopes()->where('job_id', $this->job->getJobId())->first();

        // Lookup for matching account
        $account = Account::withoutGlobalScopes()->find($this->account_id);

        // Delete job from queue if no subscription or trial expired
        if (!$account->user->subscribed('main') && !$account->user->onTrial()) {
            $this->delete();
        }

        // Create instance
        $instagram = new Instagram(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

        // Set proxy if exists
        if ($account->proxy) {
            $instagram->setProxy($account->proxy->server);
        }

        // Login to Instagram
        try {

            $instagram->login($account->username, $account->password);

        } catch (\Exception $e) {

            $log->status  = config('pilot.JOB_STATUS_FAILED');
            $log->comment = $e->getMessage();
            $log->save();

            Log::error('Something went wrong: ' . $e->getMessage());
        }

        // Simulate real human behaviour
        sleep(rand(config('pilot.SLEEP_MIN'), config('pilot.SLEEP_MAX')));

        switch ($this->message_type) {

            case 'text':

                try {

                    $instagram->direct->sendText($this->recipient, $this->params['message']);

                    $log->status = config('pilot.JOB_STATUS_SUCCESS');
                    $log->save();

                } catch (\Exception $e) {

                    $log->status  = config('pilot.JOB_STATUS_FAILED');
                    $log->comment = $e->getMessage();
                    $log->save();

                    Log::error('Something went wrong: ' . $e->getMessage());
                }

                break;

            case 'post':

                $media_type = null;

                try {

                    $media       = $instagram->media->getInfo($this->params['media_id']);
                    $media_items = $media->getItems();

                    if (count($media_items)) {
                        $media_type_code = $media_items[0]->getMediaType();
                        $media_type      = Utils::checkMediaType($media_type_code);
                    }

                    switch ($media_type) {
                        case 'PHOTO':
                        case 'ALBUM':
                            $media_type = 'photo';
                            break;
                        case 'VIDEO':
                            $media_type = 'video';
                            break;
                    }

                    sleep(rand(config('pilot.SLEEP_MIN'), config('pilot.SLEEP_MAX')));

                } catch (\Exception $e) {

                    $log->status  = config('pilot.JOB_STATUS_FAILED');
                    $log->comment = $e->getMessage();
                    $log->save();

                    Log::error('Something went wrong: ' . $e->getMessage());
                }

                try {

                    $instagram->direct->sendPost(
                        [
                            'users' => [
                                $this->pk,
                            ],
                        ],
                        $this->params['media_id'],
                        [
                            'media_type' => $media_type,
                            'text'       => $this->params['message'],
                        ]
                    );

                    $log->status = config('pilot.JOB_STATUS_SUCCESS');
                    $log->save();

                } catch (\Exception $e) {

                    $log->status  = config('pilot.JOB_STATUS_FAILED');
                    $log->comment = $e->getMessage();
                    $log->save();

                    Log::error('Something went wrong: ' . $e->getMessage());
                }

                break;

            case 'photo':

                try {

                    $instagram->direct->sendPhoto($this->recipient, $this->params['filename']);

                    $log->status = config('pilot.JOB_STATUS_SUCCESS');
                    $log->save();

                } catch (\Exception $e) {

                    $log->status  = config('pilot.JOB_STATUS_FAILED');
                    $log->comment = $e->getMessage();
                    $log->save();

                    Log::error('Something went wrong: ' . $e->getMessage());
                }

                break;

            case 'disappearingPhoto':

                try {

                    $photo = new InstagramPhoto($this->params['filename'], [
                        'targetFeed' => Constants::FEED_DIRECT_STORY,
                    ]);

                    $instagram->direct->sendDisappearingPhoto($this->recipient, $photo->getFile());

                    $log->status = config('pilot.JOB_STATUS_SUCCESS');
                    $log->save();

                } catch (\Exception $e) {

                    $log->status  = config('pilot.JOB_STATUS_FAILED');
                    $log->comment = $e->getMessage();
                    $log->save();

                    Log::error('Something went wrong: ' . $e->getMessage());
                }

                break;

            case 'video':

                try {

                    $video = new InstagramVideo($this->params['filename'], [
                        'targetFeed' => Constants::FEED_DIRECT,
                    ]);

                    $instagram->direct->sendVideo($this->recipient, $video->getFile());

                    $log->status = config('pilot.JOB_STATUS_SUCCESS');
                    $log->save();

                } catch (\Exception $e) {

                    $log->status  = config('pilot.JOB_STATUS_FAILED');
                    $log->comment = $e->getMessage();
                    $log->save();

                    Log::error('Something went wrong: ' . $e->getMessage());
                }

                break;

            case 'disappearingVideo':

                try {

                    $video = new InstagramVideo($this->params['filename'], [
                        'targetFeed' => Constants::FEED_DIRECT_STORY,
                    ]);

                    $instagram->direct->sendDisappearingVideo($this->recipient, $video->getFile());

                    $log->status = config('pilot.JOB_STATUS_SUCCESS');
                    $log->save();

                } catch (\Exception $e) {

                    $log->status  = config('pilot.JOB_STATUS_FAILED');
                    $log->comment = $e->getMessage();
                    $log->save();

                    Log::error('Something went wrong: ' . $e->getMessage());
                }

                break;

            case 'like':

                try {

                    $instagram->direct->sendLike($this->recipient);

                    $log->status = config('pilot.JOB_STATUS_SUCCESS');
                    $log->save();

                } catch (\Exception $e) {

                    $log->status  = config('pilot.JOB_STATUS_FAILED');
                    $log->comment = $e->getMessage();
                    $log->save();

                    Log::error('Something went wrong: ' . $e->getMessage());
                }

                break;

            case 'hashtag':

                try {

                    $instagram->direct->sendHashtag($this->recipient, $this->params['hashtag'], [
                        'text' => $this->params['message'],
                    ]);

                    $log->status = config('pilot.JOB_STATUS_SUCCESS');
                    $log->save();

                } catch (\Exception $e) {

                    $log->status  = config('pilot.JOB_STATUS_FAILED');
                    $log->comment = $e->getMessage();
                    $log->save();

                    Log::error('Something went wrong: ' . $e->getMessage());
                }

                break;

            case 'location':

                // sendLocation();

                break;

            case 'profile':

                // sendProfile();

                break;
        }
    }

    /**
     * The job failed to process.
     *
     * @param  Exception  $exception
     * @return void
     */
    public function failed(\Exception $e)
    {
        // Set logger
        $log = MessageLog::withoutGlobalScopes()->where('job_id', $this->job->getJobId())->first();

        $log->status  = config('pilot.JOB_STATUS_FAILED');
        $log->comment = $e->getMessage();
        $log->save();

        Log::error('Something went wrong: ' . $e->getMessage());
    }
}
