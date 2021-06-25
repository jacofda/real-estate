<?php

namespace Areaseb\Estate;

use Areaseb\Estate\Events\SheetCreated;
use Areaseb\Estate\Listeners\SendSheetToSignEmail;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SheetCreated::class => [
            SendSheetToSignEmail::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
