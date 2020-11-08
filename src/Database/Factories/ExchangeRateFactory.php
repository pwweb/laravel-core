<?php

namespace PWWEB\Core\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PWWEB\Core\Models\ExchangeRate;

 /**
  * The database factory for ExchangeRate.
  * Class AppBaseController.
  *
  * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
  * @author    Richard Browne <richard.browne@pw-websolutions.com
  * @copyright 2020 pw-websolutions.com
  * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
  * @var       \Illuminate\Database\Eloquent\Factory $factory
  */
 class ExchangeRateFactory extends Factory
 {
     /**
      * The name of the factory's corresponding model.
      *
      * @var string
      */
     protected $model = ExchangeRate::class;

     /**
      * Define the model's default state.
      *
      * @return array
      */
     public function definition()
     {
         return [
             'currency_id' => $this->faker->randomDigitNotNull,
             'rate' => $this->faker->float,
             'date' => $this->fake->date('Y-m-d'),
             'created_at' => $this->faker->date('Y-m-d H:i:s'),
             'updated_at' => $this->faker->date('Y-m-d H:i:s'),
         ];
     }
 }
