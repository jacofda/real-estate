<?php

namespace Areaseb\Estate\Listeners;

use Areaseb\Estate\Events\PrivacyCreated;
use Areaseb\Estate\Mail\PrivacyToSign;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPrivacyToSignEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PrivacyCreated $event)
    {
        Mail::send(new PrivacyToSign($event->privacy));
    }
}
