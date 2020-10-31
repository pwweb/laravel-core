<?php

namespace PWWEB\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PWWEB\Core\Models\Menu;

/**
 * The database factory for Menu.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @var       \Illuminate\Database\Eloquent\Factory $factory
 */
class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            '_lft' => $this->faker->randomDigitNotNull,
            '_rgt' => $this->faker->randomDigitNotNull,
            'parent_id' => $this->faker->randomDigitNotNull,
            'route' => $this->faker->word,
            'title' => $this->faker->word,
            'visible' => true,
            'separator' => $this->faker->word,
            'class' => $this->faker->word,
        ];
    }
}
