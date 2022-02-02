<?php

namespace Spatie\StatamicHealth\Widgets;

use Spatie\Health\ResultStores\ResultStore;
use Spatie\Health\ResultStores\StoredCheckResults\StoredCheckResult;
use Statamic\Widgets\Widget;

class HealthCheck extends Widget
{
    public function html()
    {
        $checkResults = resolve(ResultStore::class)->latestResults();
        $check = $this->config('check');

        $result = $checkResults->storedCheckResults->first(function (StoredCheckResult $result) use ($check) {
            return $result->name === $check::new()->getName();
        });

        if (! $result) {
            return null;
        }

        return view('statamic-health::widgets.health-check-widget', [
            'result' => $result,
        ]);
    }
}
