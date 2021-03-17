<?php

declare(strict_types=1);

namespace Lean\LivewireAccess;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD)]
class FrontendAccess
{
}
