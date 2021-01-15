<?php

namespace striebwj\HorizonStats\Facades;

use Illuminate\Support\Facades\Facade;

class HorizonStats extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'horizon-stats';
    }
}
