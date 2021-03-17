<?php

namespace Lean\LivewireAccess\Tests;

use Livewire\Exceptions\NonPublicComponentMethodCall;
use Livewire\Exceptions\PublicPropertyNotFoundException;
use Livewire\Livewire;

class ExplicitAccessTest extends TestCase
{
    /** @test */
    public function public_properties_are_not_accessible_by_default()
    {
        $this->expectException(PublicPropertyNotFoundException::class);

        Livewire::test(ExplicitComponent::class)
            ->call('$set', 'foo', 'xxx');
    }

    /** @test */
    public function public_properties_can_be_explicitly_accessible()
    {
        Livewire::test(ExplicitComponent::class)
            ->call('$set', 'bar', 'xxx');

        // No exception
    }

    /** @test */
    public function public_methods_are_not_accessible_by_default()
    {
        $this->expectException(NonPublicComponentMethodCall::class);

        Livewire::test(ExplicitComponent::class)
            ->call('abc');
    }

    /** @test */
    public function public_methods_can_be_explicitly_accessible()
    {
        Livewire::test(ExplicitComponent::class)
            ->call('def');

        // No exception
    }
}
