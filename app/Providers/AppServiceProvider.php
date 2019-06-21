<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use InstagramAPI\Instagram;
use InstagramAPI\Utils;
use Laravel\Cashier\Cashier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;

        Utils::$ffprobeBin = config('pilot.PATH_FFPROBE');
        Utils::$ffmpegBin  = config('pilot.PATH_FFMPEG');

        Schema::defaultStringLength(191);

        if (config('pilot.CURRENCY_CODE') && config('pilot.CURRENCY_SYMBOL')) {
            Cashier::useCurrency(config('pilot.CURRENCY_CODE'), config('pilot.CURRENCY_SYMBOL'));
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
