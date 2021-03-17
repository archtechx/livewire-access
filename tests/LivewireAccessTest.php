<?php

namespace Lean\LivewireAccess\Tests;

use Livewire\Exceptions\NonPublicComponentMethodCall;
use Livewire\Exceptions\PublicPropertyNotFoundException;
use Livewire\Livewire;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class LivewireAccessTest extends TestbenchTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
        ];
    }

    /** @test */
    public function public_properties_are_not_accessible_by_default()
    {
        $this->expectException(PublicPropertyNotFoundException::class);

        Livewire::test(TestComponent::class)
            ->call('$set', 'foo', 'xxx');
    }

    /** @test */
    public function public_properties_can_be_explicitly_accessible()
    {
        Livewire::test(TestComponent::class)
            ->call('$set', 'bar', 'xxx');

        // No exception
    }

    /** @test */
    public function public_methods_are_not_acccessible_by_default()
    {
        $this->expectException(NonPublicComponentMethodCall::class);

        Livewire::test(TestComponent::class)
            ->call('abc');
    }

    /** @test */
    public function public_methods_can_be_explicitly_accessible()
    {
        Livewire::test(TestComponent::class)
            ->call('def');

        // No exception
    }
}
