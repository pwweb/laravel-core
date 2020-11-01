<?php

/**
 * PWWEB\Core\Database\Seeders\Menu Seeder.
 *
 * Standard seeder for the Menu Model.
 *
 * @author    Frank Pillukeit <clients@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace PWWEB\Core\Database\Seeders;

use Illuminate\Database\Seeder;

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
                    ], [
                        'route' => 'core.countries',
                        'title' => 'pwweb::core.countries.plural',
                        'separator' => false,
                        'visible' => true,
                        'class' => 'fad fa-flag',
                    ], [
                        'route' => 'core.currencies',
                        'title' => 'pwweb::core.currencies.plural',
                        'separator' => false,
                        'visible' => true,
                        'class' => 'fad fa-usd-circle',
                    ], [
                        'route' => 'core.languages',
                        'title' => 'pwweb::core.languages.plural',
                        'separator' => false,
                        'visible' => true,
                        'class' => 'fad fa-language',
                    ], [
                        'route' => 'core.addresses',
                        'title' => 'pwweb::core.addresses.plural',
                        'separator' => false,
                        'visible' => true,
                        'class' => 'fad fa-address-book',
                        'children' => [
                            [
                                'route' => 'core.address.types',
                                'title' => 'pwweb::core.address.types.plural',
                                'separator' => false,
                                'visible' => true,
                                'class' => 'fad fa-map-marker-alt',
                            ],
                        ],
                    ], [
                        'route' => '',
                        'title' => 'pwweb::core.taxes.plural',
                        'separator' => true,
                        'visible' => true,
                        'class' => 'fad fa-sack-dollar',
                        'children' => [
                            [
                                'route' => 'core.tax.rates',
                                'title' => 'pwweb::core.tax.rates.plural',
                                'separator' => false,
                                'visible' => true,
                                'class' => 'fad fa-percent',
                            ], [
                                'route' => 'core.tax.locations',
                                'title' => 'pwweb::core.tax.locations.plural',
                                'separator' => false,
                                'visible' => true,
                                'class' => 'fad fa-map-marked',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $model = config('pwweb.core.models.menu');

        $model = new $model;

        foreach ($menus as $menu) {
            $model->create($menu);
        }
    }
}
