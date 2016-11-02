<?php

namespace App\Console\Commands;

use App\Jobs\MyJobTest;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test {action : the action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $action = $this->argument('action');
        switch ($action) {
            case 'queue':
                for ($i = 1; $i < 1000; $i++) {
                    $job = new MyJobTest(date("Y-m-d H:i:s"));
                    dispatch($job);
                }
                break;
            case 'start-queue':
                system('php /_html/html/tp5/laravel/artisan queue:work --daemon');
                break;
            case 'end-queue':
                system('php /_html/html/tp5/laravel/artisan queue:restart');
                break;
        }

    }
}
