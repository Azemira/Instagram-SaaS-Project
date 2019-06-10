<?php
 
namespace App\Providers;
 
use App\Classes\InstagramAPI;
use Illuminate\Support\ServiceProvider;
 
class InstagramSerivceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }
 
    public function register()
    {
        $this->app->bind('InstagramAPI', function(){
            return new InstagramAPI();
        });
    }
}