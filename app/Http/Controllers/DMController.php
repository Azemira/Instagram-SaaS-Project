<?php

namespace App\Http\Controllers;

use App\Jobs\SendMessage;
use App\Library\Helper;
use App\Library\Spintax;
use App\Models\Account;
use App\Models\Lists;
use App\Models\MessageLog;
use App\Models\Package;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use InstagramAPI\Response\Model\DirectThread;

class DMController extends Controller
{
    public function localize($locale)
    {
        $locale = array_key_exists($locale, config('languages')) ? $locale : config('app.fallback_locale');

        App::setLocale($locale);
        session()->put('locale', $locale);

        return redirect()->back();
    }

    public function dashboard(Request $request)
    {
        $user = $request->user();

        $notifications = $user->notifications()
            ->take(5)
            ->get();

        $accounts = $user->accounts()
            ->take(5)
            ->get();

        $autopilots_count = $user->autopilots()
            ->count();

        $accounts_count = $user->accounts()
            ->count();

        $messages_list_count = $user->lists()
            ->ofType('messages')
            ->count();

        $users_list_count = $user->lists()
            ->ofType('users')
            ->count();

        $messages_on_queue_count = $user->messages_on_queue()
            ->count();

        $messages_sent_count = $user->messages_sent()
            ->count();

        $messages_failed_count = $user->messages_failed()
            ->count();

        $messages_total = $messages_on_queue_count + $messages_sent_count + $messages_failed_count;

        $messages = [
            'on_queue' => [
                'total'      => $messages_on_queue_count,
                'percentage' => Helper::calc_bar($messages_on_queue_count, $messages_total),
            ],
            'sent'     => [
                'total'      => $messages_sent_count,
                'percentage' => Helper::calc_bar($messages_sent_count, $messages_total),
            ],
            'failed'   => [
                'total'      => $messages_failed_count,
                'percentage' => Helper::calc_bar($messages_failed_count, $messages_total),
            ],
        ];

        return view('dashboard', compact(
            'notifications',
            'accounts',
            'autopilots_count',
            'accounts_count',
            'messages_list_count',
            'users_list_count',
            'messages'
        ));
    }

    public function message()
    {
        $accounts       = Account::all();
        $lists          = Lists::all();
        $users_lists    = $lists->where('type', 'users');
        $messages_lists = $lists->where('type', 'messages');

        return view('message', compact(
            'accounts',
            'users_lists',
            'messages_lists'
        ));
    }

    public function message_send(Request $request)
    {
        $request->validate([
            'account_id'       => 'required',
            'audience'         => 'required',
            'message_type'     => 'required',
            'speed'            => 'required',
            'messages_list_id' => 'required_if:message_type,list',
            'users_list_id'    => 'required_if:audience,' . config('pilot.AUDIENCE_USERS_LIST'),
            'text'             => 'required_if:message_type,text',
            'hashtag'          => 'required_if:message_type,hashtag',
            'hashtag_text'     => 'required_if:message_type,hashtag',
            'media_id'         => 'required_if:message_type,post',
            'post_text'        => 'required_if:message_type,post',
            'photo'            => 'required_if:message_type,photo|mimetypes:image/jpeg,image/gif,image/png',
            'video'            => 'required_if:message_type,video|mimetypes:video/mp4',
        ]);

        $account = Account::find($request->account_id);
        if (is_null($account)) {
            return redirect()->route('dm.message')
                ->with('error', __('Account not belongs to you!'));
        }

        $audience = collect();
        switch ($request->audience) {
            case config('pilot.AUDIENCE_FOLLOWERS'):

                $audience = $account->followers()->followers()->get();

                break;

            case config('pilot.AUDIENCE_FOLLOWING'):

                $audience = $account->followers()->following()->get();

                break;

            case config('pilot.AUDIENCE_USERS_LIST'):

                $users_list = Lists::with('items')->ofType('users')->find($request->users_list_id);

                foreach ($users_list->items as $__user) {
                    $audience->push([
                        'username' => $__user->text,
                        'pk'       => null,
                    ]);
                }

                break;

            case config('pilot.AUDIENCE_DM_LIST'):

                $audience = $account->getAllThreads();

                break;

        }

        $audience_count = $audience->count();

        if ($audience_count == 0) {
            return redirect()->route('dm.message')
                ->with('error', __('There is no any records for selected target audience'));
        }

        $filename = null;
        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                $filename = $request->photo->store('uploads');
            }
        }

        if ($request->hasFile('video')) {
            if ($request->file('video')->isValid()) {
                $filename = $request->video->store('uploads');
            }
        }

        if ($request->has('disappearing') && in_array($request->message_type, ['photo', 'video'])) {
            $request->message_type = 'disappearing' . ucfirst($request->message_type);
        }

        $days        = floor($audience_count / $request->speed);
        $each_minute = floor(60 * 24 / $request->speed);
        $now         = now()->subMinutes($each_minute);

        foreach ($audience as $receiver) {

            switch ($request->message_type) {

                case 'text':
                    $message = $request->text;
                    break;

                case 'hashtag':
                    $message = $request->hashtag_text;
                    break;

                case 'list':
                    $request->message_type = 'text';
                    $message               = Lists::find($request->messages_list_id)->getText();
                    break;

                case 'post':
                    $message = $request->post_text;
                    break;

                default:
                    $message = null;
                    break;
            }

            if ($message) {
                $spintax = new Spintax();
                $message = $spintax->process($message);
            }

            if ($receiver instanceof DirectThread) {
                if ($receiver->hasThreadId()) {

                    $thread_id    = $receiver->getThreadId();
                    $thread_users = $receiver->getUsers();

                    $username = [];
                    foreach ($thread_users as $thread_user) {
                        $username[] = $thread_user->getUsername();
                    }
                }
            } else {
                $pk       = $receiver['pk'];
                $username = $receiver['username'];
            }

            $options = [
                'account_id'   => $account->id,
                'pk'           => $pk ?? null,
                'username'     => $username ?? null,
                'thread_id'    => $thread_id ?? null,
                'message_type' => $request->message_type,
                'params'       => [
                    'hashtag'  => $request->hashtag,
                    'message'  => $message,
                    'filename' => $filename ? storage_path('app' . DIRECTORY_SEPARATOR . $filename) : null,
                    'media_id' => $request->media_id,
                ],
            ];

            $job = (new SendMessage($options))
                ->onQueue('message')
                ->delay($now->addMinutes($each_minute));

            $job_id = app(Dispatcher::class)->dispatch($job);

            MessageLog::create([
                'job_id'     => $job_id,
                'user_id'    => $account->user_id,
                'account_id' => $account->id,
                'status'     => config('pilot.JOB_STATUS_ON_QUEUE'),
            ]);

        }

        return redirect()->route('dm.message')
            ->with('success', __('pilot.dm_queue_sucess', [
                'minute'         => $each_minute,
                'days'           => $days,
                'audience_count' => $audience_count,
            ]));
    }

    public function notifications(Request $request)
    {
        $data = $request->user()
            ->notifications()
            ->paginate(10);

        return view('notifications', compact(
            'data'
        ));
    }

    public function mark_notifications(Request $request)
    {
        $request->user()
            ->unreadNotifications()
            ->update(['read_at' => now()]);

        return redirect()->route('notifications')
            ->with('success', __('All notifications marked as read.'));
    }

    public function log_clear(Request $request)
    {
        if ($request->filled('status')) {

            $log = MessageLog::where('status', $request->status)->get();

            $log->each(function ($job) {
                DB::table('jobs')
                    ->where('id', $job->job_id)
                    ->delete();
                $job->delete();
            });

            if ($request->status == config('pilot.JOB_STATUS_FAILED')) {
                Artisan::call('queue:flush');
            }

            Artisan::call('queue:restart');
        }

        return redirect()->route('dashboard')
            ->with('success', __('Log cleared successfully.'));
    }

    public function landing(Request $request)
    {
        $packages        = [];
        $currency_code   = config('pilot.CURRENCY_CODE');
        $currency_symbol = config('pilot.CURRENCY_SYMBOL');
        $skin            = config('pilot.SITE_SKIN');
        $user            = $request->user();

        try {
            DB::connection()->getPdo();
            $packages = Package::all();
        } catch (\Exception $e) {

        }

        return view('skins.' . $skin . '.index', compact(
            'packages',
            'currency_code',
            'currency_symbol',
            'user'
        ));
    }


    public function cron(Request $request)
    {
        Artisan::call('schedule:run');

        return response()->json([
            'status' => 'success'
        ]);
    }
}
