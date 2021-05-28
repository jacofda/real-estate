<?php

namespace Areaseb\Estate\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;
use Areaseb\Estate\Models\Newsletter;

class NewsletterSent extends Mailable
{
    use SerializesModels;

    public $newsletter;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to(User::find(1))
                    ->subject("Invio newsletter terminato")
                    ->markdown('areaseb::emails.contacts.newsletters.newsletter-sent');
    }
}
