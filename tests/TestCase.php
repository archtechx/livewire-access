<?php

namespace Lean\LivewireAccess\Tests;

use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
        ];
    }
}
