<?php

namespace Areaseb\Estate\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Areaseb\Estate\Models\{Newsletter, Notification, Setting};
use Areaseb\Estate\Mail\NewsletterSent;

class SendNewsletterCompleted implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $name;
    public $newsletter;
    protected $id;
    protected $configuration;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name, Newsletter $newsletter)
    {
        $this->name = $name;
        $this->id = $newsletter->id;
        $this->newsletter = $newsletter;
        $this->configuration = Setting::smtp( $newsletter->smtp_id );
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::create([
            'name' => $this->name,
            'notificationable_id' => $this->id,
            'notificationable_type' => 'Areaseb\Estate\Models\Newsletter'
        ]);

        $newsletter = Newsletter::find($this->id);
        $newsletter->update(['inviata' => 1]);

        $mailer = app()->makeWith('custom.mailer', $this->configuration);
        $mailer->send( new NewsletterSent($newsletter));
    }
}
