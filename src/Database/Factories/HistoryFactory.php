<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User\Password\History;
use Faker\Generator as Faker;

/**
 * The database factory for History.
 * Class AppBaseController
 *
 * @package   pwweb/localisation
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
*/
$factory->define(History::class, function (Faker $faker) {

    return [
        'user_id' => $faker->word,
        'password' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
