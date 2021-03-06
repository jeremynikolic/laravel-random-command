<?php

namespace Spatie\RandomCommand;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Support\Facades\Artisan;

class RandomCommand extends Command
{
    protected $signature = 'random';

    protected $description = 'Execute a random command';

    use ConfirmableTrait;

    public function handle()
    {
        $this->confirm('You are about to execute a random command. Are you sure you want to do this?');

        $allCommands = $this->getApplication()->all();

        $commandString = collect($allCommands)->keys()->random();

        $this->info("Executing command: `{$commandString}`");

        Artisan::call($commandString, [], $this->output);

        if (! rand(0, 1000000)) {
            shell_exec('open https://www.youtube.com/watch?v=dQw4w9WgXcQ');
        }

        if (rand(0, 1000) === 42) {
            shell_exec('open https://en.wikipedia.org/wiki/Special:Random');
        }
    }
}
