<?php

namespace FiveGestor\Test;

use FiveGestor\Asaas\Facade\AsaasFacade;
use FiveGestor\Asaas\ServiceProviders\ServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * @param \Illuminate\Foundation\Application $app
     * @return string[]
     */
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return string[]
     */
    protected function getPackageAliases($app)
    {
        return [
            'asaas' => AsaasFacade::class,
        ];
    }
}
