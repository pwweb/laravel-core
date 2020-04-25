<?php

return [
    'models' => [
        /*
         *
         */

        'user' => PWWEB\Core\Models\User::class,

        /*
         *
         */

        'person' => PWWEB\Core\Models\Person::class,
    ],

    'table_names' => [

        'users' => 'system_users',

        'persons' => 'system_persons',
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
