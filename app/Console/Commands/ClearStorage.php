<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;
class ClearStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-storage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('cache:clear');
       
        $this->call('route:clear');
        
        $this->call('config:clear');
        
        $this->call('view:clear');
     
        File::cleanDirectory(storage_path('logs'));
      
    }
}
