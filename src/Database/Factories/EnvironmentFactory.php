<?php

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

use App\Models\System\Menu\Environment;
use Faker\Generator as Faker;

/**
 * The database factory for Environment.
 * Class AppBaseController.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
$factory->define(
    Environment::class,
    function (Faker $faker) {
        return [
            'name' => $faker->word,
            'created_at' => $faker->date('Y-m-d H:i:s'),
            'updated_at' => $faker->date('Y-m-d H:i:s'),
        ];
    }
);
