<?php

declare(strict_types=1);

namespace Lean\LivewireAccess;

use ReflectionMethod;
use ReflectionProperty;

trait WithExplicitAccess
{
    protected function methodIsPublicAndNotDefinedOnBaseClass($methodName)
    {
        return parent::methodIsPublicAndNotDefinedOnBaseClass($methodName)
            && count((new ReflectionMethod($this, $methodName))->getAttributes(FrontendAccess::class)) > 0;
    }

    public function propertyIsPublicAndNotDefinedOnBaseClass($propertyName)
    {
        return parent::propertyIsPublicAndNotDefinedOnBaseClass($propertyName)
            && count((new ReflectionProperty($this, $propertyName))->getAttributes(FrontendAccess::class)) > 0;
    }
}
