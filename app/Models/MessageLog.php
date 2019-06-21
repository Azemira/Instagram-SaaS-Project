<?php

namespace App\Models;

use App\Scopes\OwnerScope;
use Illuminate\Database\Eloquent\Model;

class MessageLog extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'job_id',
        'user_id',
        'account_id',
        'status',
        'comment',
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

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }

}
