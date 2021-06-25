<?php

namespace Areaseb\Estate\Listeners;

use Areaseb\Estate\Events\SheetCreated;
use Areaseb\Estate\Mail\SheetToSign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSheetToSignEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SheetCreated $event)
    {
        Mail::send(new SheetToSign($event->sheet));
    }
}
