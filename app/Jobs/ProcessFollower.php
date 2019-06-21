<?php

namespace App\Jobs;

use App\Jobs\SendMessage;
use App\Library\Spintax;
use App\Models\Account;
use App\Models\Autopilot;
use App\Models\MessageLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessFollower implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 7200;
    protected $account_id;
    protected $action;
    protected $pk;
    protected $username;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($options = [])
    {
        $this->account_id = $options['account_id'];
        $this->action     = $options['action'];
        $this->pk         = $options['pk'];
        $this->username   = $options['username'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Lookup for matching account
        $account = Account::withoutGlobalScopes()->find($this->account_id);

        if ($account) {

            $autopilot = Autopilot::where('account_id', $this->account_id)
                ->where('action', $this->action)
                ->with(['lists' => function ($q) {
                    $q->withoutGlobalScopes();
                }])
                ->whereRaw("NOW() BETWEEN COALESCE(`starts_at`, '1900-01-01') AND COALESCE(`ends_at`, NOW())")
                ->get();

            if ($autopilot->count()) {

                foreach ($autopilot as $AP) {

                    // Use message from list if specified
                    if ($AP->lists) {
                        $message = $AP->lists->getText();
                    } else {
                        $message = $AP->text;
                    }

                    // Spintax
                    $spintax = new Spintax();
                    $message = $spintax->process($message);

                    // Dispatch
                    $options = [
                        'account_id'   => $this->account_id,
                        'pk'           => $this->pk,
                        'thread_id'    => null,
                        'username'     => $this->username,
                        'message_type' => 'text',
                        'params'       => [
                            'message' => $message,
                        ],
                    ];

                    // Simulate real human behavior
                    sleep(rand(config('pilot.SLEEP_MIN'), config('pilot.SLEEP_MAX')));

                    $job = (new SendMessage($options))
                        ->onQueue('message')
                        ->delay(now()->addSeconds(rand(config('pilot.SLEEP_MIN'), config('pilot.SLEEP_MAX'))));

                    $job_id = app(Dispatcher::class)->dispatch($job);

                    MessageLog::create([
                        'job_id'     => $job_id,
                        'user_id'    => $account->user_id,
                        'account_id' => $account->id,
                        'status'     => config('pilot.JOB_STATUS_ON_QUEUE'),
                    ]);

                }
            }
        }
    }
}
