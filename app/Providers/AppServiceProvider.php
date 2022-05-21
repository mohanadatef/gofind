<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\Relation;

use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Relation::morphMap([
            'user'=>User::class,
        ]);
        //TODO make notifationServiceProvider
        try {
            config(['services.fcm.key' => getValueSetting('fcm_secret_key')??""]);

        }catch (\Exception $exception) {
            //
        }
        Blade::if('permission', function ($expression){
            return permissionShow($expression);
        });


    }
}
