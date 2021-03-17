<?php

declare(strict_types=1);

namespace Lean\LivewireAccess;

use ReflectionMethod;
use ReflectionProperty;

trait WithImplicitAccess
{
    protected function methodIsPublicAndNotDefinedOnBaseClass($methodName)
    {
        return parent::methodIsPublicAndNotDefinedOnBaseClass($methodName)
            && count((new ReflectionMethod($this, $methodName))->getAttributes(BlockFrontendAccess::class)) === 0;
    }

    public function propertyIsPublicAndNotDefinedOnBaseClass($propertyName)
    {
        return parent::propertyIsPublicAndNotDefinedOnBaseClass($propertyName)
            && count((new ReflectionProperty($this, $propertyName))->getAttributes(BlockFrontendAccess::class)) === 0;
    }
}
