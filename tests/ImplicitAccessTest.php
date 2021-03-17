<?php

namespace Lean\LivewireAccess\Tests;

use Livewire\Exceptions\NonPublicComponentMethodCall;
use Livewire\Exceptions\PublicPropertyNotFoundException;
use Livewire\Livewire;

class ImplicitAccessTest extends TestCase
{
    /** @test */
    public function public_properties_are_accessible_by_default()
    {
        // No exception

        Livewire::test(ImplicitComponent::class)
            ->call('$set', 'foo', 'xxx');
    }

    /** @test */
    public function public_properties_can_be_explicitly_blocked()
    {
        $this->expectException(PublicPropertyNotFoundException::class);

        Livewire::test(ImplicitComponent::class)
            ->call('$set', 'bar', 'xxx');
    }

    /** @test */
    public function public_methods_are_accessible_by_default()
    {
        Livewire::test(ImplicitComponent::class)
            ->call('abc');

        // No exception
    }

    /** @test */
    public function public_methods_can_be_explicitly_blocked()
    {
        $this->expectException(NonPublicComponentMethodCall::class);

        Livewire::test(ImplicitComponent::class)
            ->call('def');
    }
}
