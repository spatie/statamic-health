<?php

namespace Spatie\StatamicHealth\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Spatie\StatamicHealth\StatamicHealth
 */
class StatamicHealth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'statamic-health';
    }
}
