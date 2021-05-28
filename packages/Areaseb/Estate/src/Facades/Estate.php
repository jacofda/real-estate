<?php

namespace Areaseb\Estate\Facades;

use Illuminate\Support\Facades\Facade;

class Estate extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'estate';
    }
}
