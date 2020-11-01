# Laravel Core Package

[![Version](https://poser.pugx.org/pwweb/laravel-core/v/stable.svg)](https://github.com/pwweb/laravel-core/releases)
[![Downloads](https://poser.pugx.org/pwweb/laravel-core/d/total.svg)](https://github.com/pwweb/laravel-core)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/pwweb/laravel-core/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/pwweb/core/?branch=master)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

<!-- [![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis] -->

**Core**: Additional core functionalities for Laravel including the **Localisation**: C3P0 for Laravel. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer run the following:

```bash
# Install the package.
$ composer require pwweb/laravel-core

# Publish config, migration, languages and controllers.
$ php artisan vendor:publish --provider="PWWEB\Core\CoreServiceProvider"

# Run migrations
$ php artisan migrate
```

## Pre-requisites

The package assumes a standard Laravel installation if the bundled default controllers for the entities are to be used. The bundled controllers extend from  `App\Http\Controllers\Controller`. If other, custom base controllers are used as part of the installation, refer to [Customising](Customising).

## Configuration

### Customising

The package provides the following tags for publishing individual components for customising:

| Tag                     | Description                                                                       |
| ----------------------- | --------------------------------------------------------------------------------- |
| `pwweb.core.config`     | Publish the configuration files to e.g. adjust database table names.              |
| `pwweb.core.migrations` | Publish the migration file(s) to make alterations to the database tables.         |
| `pwweb.core.language`   | Publish the language files to make adjustments to the translation strings.        |
| `pwweb.core.views`      | Publish the view files to make adjustments to the overall structure of the views. |

#### Extending Models

Models can be extended to include additional functionalities or add relationships to other models. When doing so, the configuration for this package needs to be exported and the class names need to be adjusted accordingly.

```php
<?php

return [
    'models' => [
        'user' => Namespace\Of\My\User::class,
        ...
    ]
];
```

### Default and Fallback Language

It is recommended to change your `app.php` to use both the [ISO-639-1 ISO Language Code][link-iso-639] as well as the [ISO-3166 ISO Country Code][link-iso-3166]. This can be achieved by changing the following two variables:

```php
<?php

return [
    ...
    'locale' => 'en-GB',
    'fallback_locale' => 'en-GB',
    ...
];
```

## Usage

### Users and Persons

In order to use the user and person model, rather than the default user model provided out of Laravel, the `auth.php` configuration file needs to be modified to the following:

```php
<?php
'providers' => [
    'users' => [
        'driver' => 'eloquent',
        'model' => \PWWEB\Core\Models\User::class,
    ],
],
```

#### Using Laravel Auth

If the default laravel authentication is used and the controllers have been published, some changes are necessary to the `RegisterController.php`.

```php
<?php
// Add the following lines.
use PWWEB\Core\Models\User;
use PWWEB\Core\Models\Person;

// Change the following two functions.
protected function validator(array $data)
{
    return Validator::make(
        $data,
        [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::getTableName()],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]
    );
}

protected function create(array $data)
{
    $person = Person::create(
        [
            'name' => $data['name'],
            'surname' => $data['surname'],
        ]
    );

    $user = new User(
        [
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]
    );
    $user->person()->associate($person);
    $user->save();

    $user->assignRole('user');

    return $user;
}
```

### Addresses

The package provides a `trait HasAddresses` which can be used to allow models to be associated with addresses.

```php
<?php

namespace Path\To;

use Illuminate\Database\Eloquent\Model;
use PWWEB\Core\Traits\HasAddresses;

class MyModel extends Model
{
    use HasAddresses;
}
```

### Language Switcher

The localisation package provides a language switcher that can easily be added to blade templates as follows (note: the `<div>` is exemplary):

```html
...
<div class="anyContainer">
    {{ Localisation::languageSelector() }}
</div>
...
```

### GraphQL

The package provides a `graphql.schema` file for use within your parent project. This can be included in your primary `schema` file as follows:

```graphql
#import ../vendor/pwweb/laravel-core/graphql/schema.graphql
```

**Note:** don't forget to update the vendor path should yours be in a different location, relative to your primary schema file.

### Blade Directives

#### @date

The date directive allows for the display and formatting of dates using `Carbon\Carbon`. In case no date is supplied (i.e. `null`), no error is thrown and an empty string returned.
If no format is supplied, the default format from configuration is used.

```php
<?php
@date(Carbon\Carbon $date, string $format)
```

#### @menu

˜
The menu directive allows for the display of a menu based on the environment and root node provided.

```php
<?php
@menu(string $environmentSlug, string $rootNodeSlug)
```

## FAQs

During install via composer you get the following messages:

```bash
 ErrorException  : Trying to access array offset on value of type null

  at /var/www/vendor/pwweb/core/src/CoreServiceProvider.php:107
    103|     protected function registerModelBindings()
    104|     {
    105|         $config = $this->app->config['core.models'];
    106|
  > 107|         $this->app->bind(CountryContract::class, $config['country']);
    108|         $this->app->bind(LanguageContract::class, $config['language']);
    109|         $this->app->bind(CurrencyContract::class, $config['currency']);
    110|     }
    111|

  Exception trace:

  1   Illuminate\Foundation\Bootstrap\HandleExceptions::handleError("Trying to access array offset on value of type null", "/var/www/vendor/pwweb/core/src/CoreServiceProvider.php", [])
      /var/www/vendor/pwweb/core/src/CoreServiceProvider.php:107

  2   PWWeb\Localisation\CoreServiceProvider::registerModelBindings()
      /var/www/vendor/pwweb/core/src/CoreServiceProvider.php:81

  Please use the argument -v to see more details.
```

This is due to the command `php artisan config:cache` has been run. We suggest you delete the cache file `bootstrap/cache/config.php` and then run `composer dump-autoload` to be sure.

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Contributing

Please see [contributing.md](contributing.md) for details and a todo list.

## Security

If you discover any security related issues, please use the [issue tracker][link-issues].

## Credits

-   [PW\*Websolutions][link-author]
-   [All Contributors][link-contributors]

## License

Copyright © pw-websolutions.com. Please see the [license file][link-licencse] for more information.

[link-author]: https://github.com/pwweb

[link-contributors]: ../../contributors

[link-issues]: https://github.com/pwweb/laravel-core/issues

[link-licencse]: https://opensource.org/licenses/MIT

[link-iso-639]: https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes

[link-iso-3166]: https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2
