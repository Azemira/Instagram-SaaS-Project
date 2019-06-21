<?php

namespace App\Models;

use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use InstagramAPI\Instagram;
use InstagramAPI\Signatures;

class Account extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'followers_sync_at',
        'following_sync_at',
    ];

    protected $fillable = [
        'user_id',
        'proxy_id',
        'username',
        'password',
        'followers_count',
        'following_count',
        'posts_count',
        'followers_sync_at',
        'following_sync_at',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OwnerScope);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function proxy()
    {
        return $this->belongsTo('App\Models\Proxy');
    }

    public function messages_on_queue()
    {
        return $this->hasMany('App\Models\MessageLog')->where('status', config('pilot.JOB_STATUS_ON_QUEUE'));
    }

    public function messages_sent()
    {
        return $this->hasMany('App\Models\MessageLog')->where('status', config('pilot.JOB_STATUS_SUCCESS'));
    }

    public function messages_failed()
    {
        return $this->hasMany('App\Models\MessageLog')->where('status', config('pilot.JOB_STATUS_FAILED'));
    }

    public function followers()
    {
        return $this->hasMany('App\Models\Follower');
    }

    public function autopilot()
    {
        return $this->hasMany('App\Models\Autopilot');
    }

    public function getAllThreads()
    {
        $instagram = new Instagram(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

        if ($this->proxy) {
            $instagram->setProxy($this->proxy->server);
        }

        try {
            $instagram->login($this->username, $this->password);
        } catch (\Exception $e) {
            Log::error('Something went wrong: ' . $e->getMessage());
        }

        $threads = [];
        try {

            $cursorId = null;

            do {

                $response = $instagram->direct->getInbox($cursorId);

                $cursorId = $response->getInbox()->getOldestCursor();

                $threads = array_merge($threads, $response->getInbox()->getThreads());

            } while ($response->getInbox()->getHasOlder());

        } catch (\Exception $e) {
            Log::error('Something went wrong: ' . $e->getMessage());
        }

        return collect($threads);

    }

    public function searchHashtag($hashtag, $limit = 100)
    {
        $result = [];

        $instagram = new Instagram(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

        if ($this->proxy) {
            $instagram->setProxy($this->proxy->server);
        }

        try {
            $instagram->login($this->username, $this->password);
        } catch (\Exception $e) {
            Log::error('Something went wrong: ' . $e->getMessage());
        }

        try {

            $rankToken = Signatures::generateUUID();

            $maxId = null;

            do {

                $response = $instagram->hashtag->getFeed($hashtag, $rankToken, $maxId);

                if ($response->hasItems()) {

                    foreach ($response->getItems() as $item) {

                        $user = $item->getUser();

                        $result[$user->getPk()] = $user->getUsername();
                    }

                }

                $maxId = $response->getNextMaxId();

            } while ($maxId !== null || count($result) <= $limit);

        } catch (\Exception $e) {
            Log::error('Something went wrong: ' . $e->getMessage());
        }

        return $result;

    }

}
