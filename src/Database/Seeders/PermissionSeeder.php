<?php

/**
 * PWWEB\Core\Database\Seeders\Permission Seeder.
 *
 * Standard seeder for the Permission Model.
 *
 * @author    Frank Pillukeit <clients@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace PWWEB\Core\Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Admin' => [
                'view',
                'edit',
                'add',
                'delete',
            ],
            'Users' => [
                'view',
            ],
        ];

        $systems = [
            'users',
            'roles',
            'permissions',
            'addresses',
            'countries',
            'currencies',
            'languages',
            'menus',
            'persons',
            'profiles',
            'tax_rates',
            'tax_locations',
            'address_types',
        ];

        $roleModel = config('permission.models.role');
        $permissionModel = config('permission.models.permission');

        $roleModel = new $roleModel;
        $permissionModel = new $permissionModel;

        foreach ($roles as $key => $abilities) {
            $roleModel = $roleModel->firstOrCreate(['name' => $key]);
            foreach ($systems as $system) {
                foreach ($abilities as $ability) {
                    $permissionModel->firstOrCreate(['name' => $ability.'_'.$system]);
                    $permissionModel->assignRole($roleModel);
                }
            }
        }
    }
}
