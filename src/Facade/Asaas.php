<?php

namespace FiveGestor\Asaas\Facade;

use Illuminate\Support\Facades\Facade as IlluminateFacade;

class Asaas extends IlluminateFacade
{
    protected static function getFacadeAccessor()
    {
        return 'asaas.wrapper';
    }
}
