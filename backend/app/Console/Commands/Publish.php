<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class Publish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:event {channel} {data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish events';

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
     */
    public function handle()
    {
        $channel = $this->argument('channel');
        $data = $this->argument('data');
        $this->info("Channel {$channel}!");
        $this->info("Data {$data}!");
        $result = Redis::publish(
            $channel,
            $data
        );
        $this->info("Resultado {$result}!");
    }
}