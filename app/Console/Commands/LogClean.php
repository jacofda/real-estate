<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Areaseb\Core\Models\Cron;
use \Carbon\Carbon;

class LogClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove old logs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $latestReminder = Cron::where('name', '!=', 'reminder')->latest()->first();
        Cron::truncate();
        if(!is_null($latestReminder))
        {
            Cron::create(['name' => 'reminder', 'created_at' => $latestReminder->created_at, 'updated_at' => $latestReminder->updated_at]);
        }
        Cron::create(['name' => 'jobless']);
    }
}
