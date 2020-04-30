<?php

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */

use App\Models\System\Menu\Item;
use Faker\Generator as Faker;

/**
 * The database factory for Item.
 * Class AppBaseController
 *
 * @package   pwweb/localisation
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
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
        'class' => $faker->word
        ];
    }
);
