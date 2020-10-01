<?php

namespace PWWEB\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
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
class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
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
}
