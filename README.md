# Laravel Core Package

[![Version](https://poser.pugx.org/pwweb/laravel-core/v/stable.svg)](https://github.com/pwweb/laravel-core/releases)
[![Downloads](https://poser.pugx.org/pwweb/laravel-core/d/total.svg)](https://github.com/pwweb/laravel-core)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pwweb/laravel-core/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pwweb/core/?branch=master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
<!-- [![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis] -->

**Core**: Additional core functionalities for Laravel. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer run the following:

``` bash
# Install the package.
$ composer require pwweb/laravel-core

# Publish config, migration, languages and controllers.
$ php artisan vendor:publish --provider="PWWEB\Core\CoreServiceProvider"

# Run migrations
$ php artisan migrate
```

## Configuration

### Customizing
Not applicable at the moment.

## Usage

### Users and Persons
In order to use the user and person model, rather than the default user model provided out of Laravel, the `auth.php` configuration file needs to be modified to the following:
```php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => \PWWEB\Core\Models\User::class,
    ],
],
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please use the [issue tracker][link-issues].

## Credits

- [PW*Websolutions][link-author]
- [All Contributors][link-contributors]

## License

Copyright &copy; pw-websolutions.com. Please see the [license file][link-licencse] for more information.

[link-author]: https://github.com/pwweb
[link-contributors]: ../../contributors
[link-issues]: https://github.com/pwweb/laravel-core/issues
[link-licencse]: https://opensource.org/licenses/MIT
