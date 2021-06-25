<?php

namespace Areaseb\Estate\Mail;

use Areaseb\Estate\Models\Sheet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SheetToSign extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Sheet
     */
    public $sheet;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sheet $sheet)
    {
        $this->sheet = $sheet;
        $this->email = $this->sheet->client->email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)
            ->subject('Foglio di visita da firmare')
            ->markdown('estate::emails.sheets.send', [
                'url' => '#' // TODO: Add real link
            ]);
    }
}
