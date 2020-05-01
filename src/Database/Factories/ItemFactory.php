<?php

use Faker\Generator as Faker;
use PWWEB\Core\Models\Menu\Item;

/**
 * The database factory for Item.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @var       \Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(
    Item::class,
    function (Faker $faker) {
        return [
            'system_menu_environments_id' => $faker->randomDigitNotNull,
            '_lft' => $faker->randomDigitNotNull,
            '_rgt' => $faker->randomDigitNotNull,
            'parent_id' => $faker->randomDigitNotNull,
            'level' => $faker->randomDigitNotNull,
            'identifier' => $faker->word,
            'title' => $faker->word,
            'separator' => $faker->word,
            'class' => $faker->word,
        ];
    }
);
