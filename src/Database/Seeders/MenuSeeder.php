<?php

/**
 * PWWEB\Localisation\Database\Seeders\Menu Seeder.
 *
 * Standard seeder for the Menu Model.
 *
 * @author    Frank Pillukeit <clients@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace PWWEB\Localisation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Initializing variables.
        $menus = [
            [
                'route' => 'frontend',
                'title' => 'frontend',
                'separator' => false,
                'class' => '',
                'visible' => false,
            ],
            [
                'route' => 'backend',
                'title' => 'backend',
                'separator' => false,
                'class' => '',
                'visible' => false,
                'children' => [
                    [
                        'route' => 'core.persons',
                        'title' => 'pwweb::core.persons.plural',
                        'separator' => false,
                        'visible' => true,
                        'class' => 'fad fa-user-circle',
                    ], [
                        'route' => 'core.users',
                        'title' => 'pwweb::core.users.plural',
                        'separator' => false,
                        'visible' => true,
                        'class' => 'fad fa-users',
                    ], [
                        'route' => 'core.menus',
                        'title' => 'pwweb::core.menus.plural',
                        'separator' => false,
                        'visible' => true,
                        'class' => 'fad fa-compass',
                    ],
                ],
            ],
        ];

        $model = new (config('pwweb.core.models.menu'))();

        foreach ($menus as $id => $menu) {
            $model->create($menu);
        }
    }
}
