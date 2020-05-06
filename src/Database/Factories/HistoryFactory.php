<?php

use Faker\Generator as Faker;
use PWWEB\Core\Models\User\Password\History;

/**
 * The database factory for Historic Password.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @var       \Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(
    History::class,
    function (Faker $faker) {
        return [
            'user_id' => $faker->word,
            'password' => $faker->word,
            'created_at' => $faker->date('Y-m-d H:i:s'),
            'updated_at' => $faker->date('Y-m-d H:i:s')
        ];
    }
);
