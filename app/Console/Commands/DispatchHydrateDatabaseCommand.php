<?php

namespace App\Console\Commands;

use App\Jobs\RequestCustomersFakerApi;
use App\Jobs\RequestFakerApi;
use App\Jobs\RequestProductsFakerApi;
use Illuminate\Console\Command;

class DispatchHydrateDatabaseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dispatch:hydrate-database {quantity=5000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hydrate database using the faker api';

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
        $this->info("Dispatching jobs");
        $quantity = $this->argument('quantity');
        $this->info("Total: " . $quantity);
        RequestCustomersFakerApi::dispatch($quantity);
        RequestProductsFakerApi::dispatch($quantity);
        return 0;
    }
}
