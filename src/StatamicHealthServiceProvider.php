<?php

namespace Spatie\StatamicHealth;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\StatamicHealth\Commands\StatamicHealthCommand;

class StatamicHealthServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('statamic-health')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_statamic-health_table')
            ->hasCommand(StatamicHealthCommand::class);
    }
}
