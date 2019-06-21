<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use Notifiable, Billable;

    protected $dates = [
        'created_at',
        'updated_at',
        'email_verified_at',
        'trial_ends_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_admin',
        'name',
        'email',
        'password',
        'trial_ends_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_admin' => 'boolean',
    ];

    /**
     * Specify the tax percentage a user pays on a subscription
     * Numeric value between 0 and 100, with no more than 2 decimal places.
     */
    public function taxPercentage()
    {
        return config('pilot.TAX_PERCENTAGE');
    }

    public function accounts()
    {
        return $this->hasMany('App\Models\Account');
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

    public function lists()
    {
        return $this->hasMany('App\Models\Lists');
    }

    public function autopilots()
    {
        return $this->hasManyThrough('App\Models\Autopilot', 'App\Models\Account');
    }

    public function package()
    {
        return $this->belongsTo('App\Models\Package')->withDefault([
            'accounts_count' => 0,
            'title'          => '',
        ]);
    }
}
