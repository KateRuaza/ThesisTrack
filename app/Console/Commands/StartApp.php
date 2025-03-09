<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class StartApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:start-app';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start all necessary Laravel services';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $commands = [
            ['php', 'artisan', 'serve'],
            ['php', 'artisan', 'queue:work'],
            ['php', 'artisan', 'schedule:work'],
            ['php', 'artisan', 'reverb:start'],
        ];

        $processes = [];

        foreach ($commands as $command) {
            $process = new Process($command);
            $process->setTimeout(null);
            $process->start();

            $processes[] = $process;
            $this->info('Started: '.implode(' ', $command));
        }

        while (true) {
            foreach ($processes as $process) {
                if ($process->isRunning()) {
                    $this->output->write($process->getIncrementalOutput());
                    $this->output->write($process->getIncrementalErrorOutput());
                }
            }
            usleep(500000);
        }
    }
}
