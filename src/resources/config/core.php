<?php

return [
    'password_history_num' => env('PASSWORD_HISTORY_NUM', 3),

    'date_format' => 'd.m.Y H:i:s',

    'models' => [
        /*
         *
         */

        'user' => PWWEB\Core\Models\User::class,

        /*
         *
         */

        'user_password_history' => PWWEB\Core\Models\User\Password\History::class,

        /*
         *
         */

        'person' => PWWEB\Core\Models\Person::class,

        /*
         *
         */

        'menu' => PWWEB\Core\Models\Menu::class,
        /*
         *
         */

        'address' => PWWEB\Core\Models\Address::class,

        /*
         *
         */

        'address_type' => PWWEB\Core\Models\Address\Type::class,

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Country" model but you may use whatever you like.
         *
         * The model you want to use as a Country model needs to implement the
         * `PWWEB\Core\Contracts\Country` contract.
         */

        'country' => PWWEB\Core\Models\Country::class,

        /*
         * When using the "HasPermissions" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your permissions. Of course, it
         * is often just the "Country" model but you may use whatever you like.
         *
         * The model you want to use as a Country model needs to implement the
         * `PWWEB\Core\Contracts\Country` contract.
         */

        'country' => PWWEB\Core\Models\Country::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Language" model but you may use whatever you like.
         *
         * The model you want to use as a Language model needs to implement the
         * `PWWEB\Core\Contracts\Language` contract.
         */

        'language' => PWWEB\Core\Models\Language::class,

        /*
         * When using the "HasRoles" trait from this package, we need to know which
         * Eloquent model should be used to retrieve your roles. Of course, it
         * is often just the "Currency" model but you may use whatever you like.
         *
         * The model you want to use as a Currency model needs to implement the
         * `PWWEB\Core\Contracts\Currency` contract.
         */

        'currency' => PWWEB\Core\Models\Currency::class,

        /*
         * The model you want to use as for the Tax models.
         */

        'tax' => [

            /*
             * The model you want to use as a Rate model needs to implement the
             * `PWWEB\Core\Contracts\Tax\Rate` contract.
             */

            'rate' => PWWEB\Core\Models\Tax\Rate::class,

            /*
             * The model you want to use as a Location model needs to implement the
             * `PWWEB\Core\Contracts\Tax\Location` contract.
             */

            'location' => PWWEB\Core\Models\Tax\Location::class,
        ],
    ],

    'table_names' => [

        'users' => 'system_users',

        'user_password_histories' => 'system_users_passwords',

        'persons' => 'system_persons',

        'menus' => 'system_menus',

        'addresses' => 'system_addresses',

        'address_types' => 'system_address_types',

        'countries' => 'system_localisation_countries',

        'languages' => 'system_localisation_languages',

        'currencies' => 'system_localisation_currencies',

        'country_has_language' => 'system_localisation_country_languages',

        'model_has_address' => 'system_model_has_address',

        'tax' => [

            'rates' => 'system_tax_rates',

            'locations' => 'system_tax_locations',
        ],
    ],

    'column_names' => [
        /*
         * Change this if you want to name the related model primary key other than
         * `model_id`.
         *
         * For example, this would be nice if your primary keys are all UUIDs. In
         * that case, name this `model_uuid`.
         */

        'model_morph_key' => 'model_id',
    ],

    'cache' => [
        /*
         * By default all permissions are cached for 24 hours to speed up performance.
         * When permissions or roles are updated the cache is flushed automatically.
         */

        'expiration_time' => \DateInterval::createFromDateString('24 hours'),

        /*
         * The cache key used to store all permissions.
         */

        'key' => 'pwweb.core.cache',

        /*
         * When checking for a permission against a model by passing a Permission
         * instance to the check, this key determines what attribute on the
         * Language model is used to cache against.
         *
         * Ideally, this should match your preferred way of checking languages, eg:
         * `$languages->enabled('german')` would be 'name'.
         */

        'model_key' => 'name',

        /*
         * You may optionally indicate a specific cache driver to use for permission and
         * role caching using any of the `store` drivers listed in the cache.php config
         * file. Using 'default' here means to use the `default` set in cache.php.
         */

        'store' => 'default',
    ],
];
