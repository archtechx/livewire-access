<?php

declare(strict_types=1);

namespace Lean\LivewireAccess;

use Illuminate\Support\Str;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

trait WithExplicitAccess
{
    protected function methodIsPublicAndNotDefinedOnBaseClass($methodName)
    {
        $livewireMethods = collect((new ReflectionClass($this))->getTraits()) // Get all traits
            ->filter(fn ($reflection, $traitName) => Str::startsWith($traitName, 'Livewire\\')) // Filter those in Livewire namespace
            ->map(fn (ReflectionClass $trait) => $trait->getMethods()) // Get their methods
            ->map(fn (array $methods) => collect($methods)->map(fn (ReflectionMethod $method) => $method->getName())) // Convert the methods to collections of method names
            ->flatten(); // Flatten the collection to get merge the inner collections with method names

        return parent::methodIsPublicAndNotDefinedOnBaseClass($methodName)
            && ($livewireMethods->contains($methodName) || (count((new ReflectionMethod($this, $methodName))->getAttributes(FrontendAccess::class)) > 0));
    }

    public function propertyIsPublicAndNotDefinedOnBaseClass($propertyName)
    {
        $livewireProperties = collect((new ReflectionClass($this))->getTraits()) // Get all traits
            ->filter(fn ($reflection, $traitName) => Str::startsWith($traitName, 'Livewire\\')) // Filter those in Livewire namespace
            ->map(fn (ReflectionClass $trait) => $trait->getProperties()) // Get their properties
            ->map(fn (array $properties) => collect($properties)->map(fn (ReflectionProperty $method) => $method->getName())) // Convert the methods to collections of property names
            ->flatten(); // Flatten the collection to get merge the inner collections with property names

        return parent::propertyIsPublicAndNotDefinedOnBaseClass($propertyName)
            && ($livewireProperties->contains($propertyName) || (count((new ReflectionProperty($this, $propertyName))->getAttributes(FrontendAccess::class)) > 0));
    }
}
