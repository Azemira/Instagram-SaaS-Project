<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Package extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'title',
        'price',
        'interval',
        'accounts_count',
    ];

    public function getPlanIdAttribute()
    {
        return Str::lower(
            'plan-'
            . $this->id . '-'
            . Str::slug($this->title, '-') . '-'
            . $this->whole_price . '-'
            . $this->fraction_price . '-'
            . config('pilot.CURRENCY_CODE') . '-'
            . $this->interval
        );
    }

    public function getPriceInCentsAttribute()
    {
        return $this->price * 100;
    }

    public function getWholePriceAttribute()
    {
        return floor($this->price);
    }

    public function getFractionPriceAttribute()
    {
        return ltrim(round($this->price - $this->whole_price, 2), '0.');
    }

}
