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
    ],

    'table_names' => [

        'users' => 'system_users',

        'user_password_histories' => 'system_users_passwords',

        'persons' => 'system_persons',

        'menus' => 'system_menus',
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
];
