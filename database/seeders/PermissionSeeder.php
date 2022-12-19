<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name'=>'create customers']);
        Permission::create(['name'=>'read customers']);
        Permission::create(['name'=>'update customers']);
        Permission::create(['name'=>'delete customers']);

        Permission::create(['name'=>'create users']);
        Permission::create(['name'=>'read users']);
        Permission::create(['name'=>'update users']);
        Permission::create(['name'=>'delete users']);

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleCashier = Role::create(['name' => 'cashier']);

        $roleAdmin -> givePermissionto([
        'create customers',
        'read customers',
        'update customers',
        'create users',
        'read users',
        'update users',
        'delete users',
        ]);

        $roleCashier -> givePermissionto([
            'read customers',
        ]);
    }
}
