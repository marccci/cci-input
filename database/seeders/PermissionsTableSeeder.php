<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'car_management_access',
            ],
            [
                'id'    => 18,
                'title' => 'manufacturer_create',
            ],
            [
                'id'    => 19,
                'title' => 'manufacturer_edit',
            ],
            [
                'id'    => 20,
                'title' => 'manufacturer_show',
            ],
            [
                'id'    => 21,
                'title' => 'manufacturer_delete',
            ],
            [
                'id'    => 22,
                'title' => 'manufacturer_access',
            ],
            [
                'id'    => 23,
                'title' => 'engine_create',
            ],
            [
                'id'    => 24,
                'title' => 'engine_edit',
            ],
            [
                'id'    => 25,
                'title' => 'engine_show',
            ],
            [
                'id'    => 26,
                'title' => 'engine_delete',
            ],
            [
                'id'    => 27,
                'title' => 'engine_access',
            ],
            [
                'id'    => 28,
                'title' => 'car_create',
            ],
            [
                'id'    => 29,
                'title' => 'car_edit',
            ],
            [
                'id'    => 30,
                'title' => 'car_show',
            ],
            [
                'id'    => 31,
                'title' => 'car_delete',
            ],
            [
                'id'    => 32,
                'title' => 'car_access',
            ],
            [
                'id'    => 33,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 34,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 35,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 36,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 37,
                'title' => 'car_user_access',
            ],
            [
                'id'    => 38,
                'title' => 'garage_create',
            ],
            [
                'id'    => 39,
                'title' => 'garage_edit',
            ],
            [
                'id'    => 40,
                'title' => 'garage_show',
            ],
            [
                'id'    => 41,
                'title' => 'garage_delete',
            ],
            [
                'id'    => 42,
                'title' => 'garage_access',
            ],
            [
                'id'    => 43,
                'title' => 'carmodel_create',
            ],
            [
                'id'    => 44,
                'title' => 'carmodel_edit',
            ],
            [
                'id'    => 45,
                'title' => 'carmodel_show',
            ],
            [
                'id'    => 46,
                'title' => 'carmodel_delete',
            ],
            [
                'id'    => 47,
                'title' => 'carmodel_access',
            ],
            [
                'id'    => 48,
                'title' => 'ownership_create',
            ],
            [
                'id'    => 49,
                'title' => 'ownership_edit',
            ],
            [
                'id'    => 50,
                'title' => 'ownership_show',
            ],
            [
                'id'    => 51,
                'title' => 'ownership_delete',
            ],
            [
                'id'    => 52,
                'title' => 'ownership_access',
            ],
            [
                'id'    => 53,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
