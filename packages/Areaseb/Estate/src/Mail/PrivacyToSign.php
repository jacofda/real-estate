<?php

namespace Areaseb\Estate\Mail;

use Areaseb\Estate\Models\Privacy;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PrivacyToSign extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Privacy
     */
    public $privacy;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Privacy $privacy)
    {
        $this->privacy = $privacy;
        $this->email = $this->privacy->client->email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)
            ->subject('Privacy da firmare')
            ->markdown('estate::emails.privacy.send', [
                'url' => route('privacy.sign', ['uuid' => $this->privacy->uuid])
            ]);
    }
}
