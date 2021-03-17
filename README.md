# Explicit property/method access for Livewire

This package adds PHP 8.0 attribute support to Livewire. In specific, the attributes are used for flagging component properties and methods as *frontend-accessible*.

Components which implement the trait provided by this package will implicitly deny access to all properties and methods if they don't have the `#[FrontendAccess]` attribute, regardless of their visibility.

## Installation

```sh
composer require leanadmin/livewire-access
```

## Usage

```php
use Livewire\Component;
use Lean\LivewireAccess\WithExplicitAccess;
use Lean\LivewireAccess\FrontendAccess;

class MyComponent extends Component
{
    // Use the trait on your component to enable this functionality
    use WithExplicitAccess;

    // Accessing this from the frontend will throw an exception
    public string $inaccessible;

    #[FrontendAccess]
    public string $accessible; // This property allows frontend access

    public function secretMethod()
    {
        // Calling this from the frontend will throw an exception
    }

    #[FrontendAccess]
    public function secretMethod()
    {
        // This method allows frontend access
    }
}
```

The properties still need to be `public` to be accessible.

The thrown exceptions are identical to those that Livewire would throw if the properties/methods were not public.

## Development

Running all checks locally:

```sh
./check
```

Running tests:

```sh
phpunit
```

Code style will be automatically fixed by php-cs-fixer.
