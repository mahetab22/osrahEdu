<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Events\Dispatcher;
use TCG\Voyager\Facades\Voyager;
use App\VisitorRegistry;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        URL::forceScheme('https');
        Voyager::addAction(\App\Actions\activatesub::class);
        Voyager::addAction(\App\Actions\superactive::class);
        Voyager::addAction(\App\Actions\courseactive::class);
        Voyager::addAction(\App\Actions\studcourse::class);
        Voyager::addAction(\App\Actions\stop_subscription::class);
        Voyager::addAction(\App\Actions\payForMarketer::class);
//         if (!empty($_SERVER['HTTP_CLIENT_IP']))
//         {
//             $ip_address = $_SERVER['HTTP_CLIENT_IP'];
//         }
// //whether ip is from proxy
//         elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
//         {
//             $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
//         }
// //whether ip is from remote address
//         else
//         {
//             $ip_address = $_SERVER['REMOTE_ADDR'];
//         }
//        // echo $ip_address;

//         if(!VisitorRegistry::where('ip',$ip_address)->first())
//             VisitorRegistry::create(['ip'=>$ip_address]);
    }
}
