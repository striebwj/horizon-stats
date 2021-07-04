<?php

namespace striebwj\HorizonStats\Console\Commands;

use Illuminate\Console\Command;
use striebwj\HorizonStats\HorizonStats;

class StoreHorizonStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'horizon-stats:store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the most recent Horizon Snapshot in the DB.';

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
     * @return int
     */
    public function handle()
    {
        HorizonStats::storeSnapshotData();

        return 0;
    }
}
