<?php

namespace Spatie\StatamicHealth\Commands;

use Illuminate\Console\Command;

class StatamicHealthCommand extends Command
{
    public $signature = 'statamic-health';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
