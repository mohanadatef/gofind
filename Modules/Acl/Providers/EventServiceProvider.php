<?php

namespace Modules\Acl\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Acl\Events\approveEmailEvent;
use Modules\Acl\Events\verifiedEmailEvent;
use Modules\Acl\Listeners\approveEmailListener;
use Modules\Acl\Listeners\verifiedEmailListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
