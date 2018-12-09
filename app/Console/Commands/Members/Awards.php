<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Awards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Members:awards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Issue awards to eligible members.';

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
        /**
         * TODO: Implement command to issue awards to members who should have them from community_awards.
         * This will be useful for the initial deployment of these awards and to run nightly to ensure everything stays in sync.
         */
    }
}
