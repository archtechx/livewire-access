<?php

namespace Lean\LivewireAccess\Tests;

use Lean\LivewireAccess\BlockFrontendAccess;
use Lean\LivewireAccess\WithImplicitAccess;
use Livewire\Component;

class ImplicitComponent extends Component
{
    use WithImplicitAccess;

    public string $foo = 'foo';

    #[BlockFrontendAccess]
    public string $bar = 'bar';

    public function abc() {}

    #[BlockFrontendAccess]
    public function def() {}

    public function render()
    {
        return '';
    }
}
