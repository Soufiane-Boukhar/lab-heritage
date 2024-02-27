<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Migrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'run all migrations from folders';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        // Load migrations from multiple directories
        $mainPath = database_path('migrations');
        $directories = glob($mainPath . '/*', GLOB_ONLYDIR);
        $paths = array_merge([$mainPath], $directories);

        foreach ($paths as $path) {
            $this->loadMigrationsFromPath($path);
        }

        
        $this->call('migrate', [
            '--force' => true,
        ]);
    }

    /**
     * Load migrations from a directory.
     *
     * @param string $path
     * @return void
     */
    protected function loadMigrationsFromPath($path)
    {
        $files = File::glob("{$path}/*.php");

        foreach ($files as $file) {
            require_once $file;
        }
    }
}
