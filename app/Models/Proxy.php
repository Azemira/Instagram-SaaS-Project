<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proxy extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'expires_at',
    ];

    protected $fillable = [
        'server',
        'country',
        'expires_at',
    ];

    public function accounts()
    {
        return $this->hasMany('App\Models\Account');
    }

    public function getUseCountAttribute()
    {
        return $this->accounts->where('proxy_id', $this->id)->count();
    }
}
