<?php

namespace Spatie\StatamicHealth;

use Spatie\Health\Facades\Health;
use Statamic\Facades\CP\Nav;
use Statamic\Providers\AddonServiceProvider;

class StatamicHealthServiceProvider extends AddonServiceProvider
{
    protected $widgets = [
        Widgets\HealthCheck::class,
    ];

    protected $routes = [
        'cp' => __DIR__ . '/../routes/cp.php',
    ];

    public function bootAddon()
    {
        if (Health::registeredChecks()->count() > 0 && config('health.statamic.enable_dashboard', true)) {
            Nav::extend(function (\Statamic\CP\Navigation\Nav $nav) {
                $nav->tools('Health')
                    ->route('health.index')
                    ->icon('charts');
            });
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'statamic-health');
    }
}
