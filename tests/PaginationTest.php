<?php

namespace Lean\LivewireAccess\Tests;

use Livewire\Livewire;

class PaginationTest extends TestCase
{
    /** @test */
    public function livewire_trait_methods_are_supported()
    {
        Livewire::test(PaginatedComponent::class)
            ->call('gotoPage', 2);
    }

    /** @test */
    public function livewire_trait_properties_are_supported()
    {
        Livewire::test(PaginatedComponent::class)
            ->call('$set', 'page', 3);
    }
}
