<?php

namespace KEBHanna\FinfluxSDK\Facades;

use Illuminate\Support\Facades\Facade;

class FinfluxSDK extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'finfluxsdk';
    }
}
