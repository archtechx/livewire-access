# Package

## Installation

```sh
composer require stancl/package
```

## Usage

```php
// ...
```

## Development

Running all checks locally:

```sh
./check
```

Running tests:

```sh
MYSQL_PORT=3307 docker-compose up -d

phpunit
```

Code style will be automatically fixed by php-cs-fixer.
