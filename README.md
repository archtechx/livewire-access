# Livewire Access

This package adds PHP 8.0 attribute support to Livewire. In specific, the attributes are used for flagging component properties and methods as *frontend-accessible*.

The package ships with two pairs of traits and attributes. One for *explicit* access, and one for *implicit* access.

## How it works

- Components which implement the trait for **explicit** access will *deny* access to all properties and methods if they don't have the `#[FrontendAccess]` attribute.
- Components which implement the trait for **implicit** access will *allow* access to all properties and methods unless they have the `#[BlockFrontendAccess]` attribute.

This acts as a layer on top of Livewire's `public`-check logic, but gives you much more fine grained control.

## Why use this?

Sometimes, you may want allow access to a component's property in PHP — outside the component — while not allowing access from the frontend. For that, you can use the `WithImplicitAccess` trait. Frontend access will be enabled for all properties by default, but you can disable it for a specific property (or method).

Other times, you may simply want more assurance than Livewire provides out of the box. The `WithExplicitAccess` trait is made for that. It disables all frontend access, and requires you to manually enable it on specific properties/methods.

The second option is recommended, because it provides the most security benefits. Accidentally making methods `public` is common, and it can cause security issues. Disabling implicit access can be especially useful on teams with junior engineers who don't yet have a full understanding of Livewire's internals, but can be very productive with it.

## Practical use case

Say you have a component with the following method:

```php
public function getItemsProperty()
{
    return [
      ['secret' => false, 'name' => 'Item 1'],
      ['secret' => true, 'name' => 'Item 2'],
      ['secret' => true, 'name' => 'Item 3'],
      ['secret' => false, 'name' => 'Item 4'],
    ];
}
```

In the Blade template, you want to loop through the items and only display the non-secret ones.

```html
@foreach($this->items->filter(...) as $item)
```

However, the entire dataset will be accessible from the frontend, even if you're not rendering any of the secret items.

The user can easily fetch the Livewire component in Developer Tools and make a call like this:

```js
component.call('getItemsProperty');
```

It will return all of the data returned by the `getItemsProperty()` method in PHP.

<img width="348" alt="Screen Shot 2021-03-17 at 21 53 00" src="https://user-images.githubusercontent.com/33033094/111536933-26f87680-876b-11eb-98c5-8b7f40f1a5de.png">

You may think that in this case, you should just make the method `protected`/`private`. However, that would make it inaccessible from the Blade template. Even though Livewire uses `$this` in the template, it's accessing the object from the outside.

Which means that although Blade templates are completely server-rendered, and let you access any PHP code in a secure way, you cannot access many of the properties or methods of Livewire components without making them public, which can cause unexpected data leaks.

With this package, you can keep the property public and access it anywhere in PHP, while completely blocking any attempts at accessing it from the frontend.

## Installation

PHP 8 is required.

```sh
composer require leanadmin/livewire-access
```

## Usage

This package doesn't make any changes to your existing code. Components which don't implement either one of its traits will not be affected.

### Explicit access

To enable the explicit access mode, i.e. only enable access to properties/methods that explicitly allow it, use the `WithExplicitAccess` trait.

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
    public function publicMethod()
    {
        // This method allows frontend access
    }
}
```

### Implicit access

To enable the implicit access mode, i.e. keep using the same mode , use the `WithExplicitAccess` trait.

```php
use Livewire\Component;
use Lean\LivewireAccess\WithImplicitAccess;
use Lean\LivewireAccess\BlockFrontendAccess;

class MyComponent extends Component
{
    // Use the trait on your component to enable this functionality
    use WithImplicitAccess;

    // This property allows frontend access
    public string $accessible;

    #[BlockFrontendAccess]
    public string $inaccessible; // This property blocks frontend access

    public function publicMethod()
    {
        // This method allows frontend access
    }

    #[BlockFrontendAccess]
    public function secretMethod()
    {
        // This method blocks frontend access
    }
}
```

### Details

- The properties still need to be `public` to be accessible.
- The thrown exceptions are identical to those that Livewire would throw if the properties/methods were not public.

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
