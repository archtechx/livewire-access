<?php

namespace Lean\LivewireAccess\Tests;

use Lean\LivewireAccess\WithExplicitAccess;
use Lean\LivewireAccess\FrontendAccess;
use Livewire\Component;
use Livewire\WithPagination;

class PaginatedComponent extends Component
{
    use WithExplicitAccess, WithPagination;

    public string $foo = 'foo';

    #[FrontendAccess]
    public string $bar = 'bar';

    public function abc() {}

    #[FrontendAccess]
    public function def() {}

    public function render()
    {
        return '';
    }
}
