<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DeleteOldNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete notifications older than one month';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deleted = DB::table('notifications')
            ->where('created_at', '<', Carbon::now()->subMonth())
            ->delete();

        $this->info("Deleted {$deleted} notifications.");

        return Command::SUCCESS;
    }
}
