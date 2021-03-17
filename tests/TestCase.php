<?php

namespace Stancl\Package\Tests;

use Orchestra\Testbench\TestCase as TestbenchTestCase;
use Stancl\Package\PackageServiceProvider;

class TestCase extends TestbenchTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            PackageServiceProvider::class,
        ];
    }
}
