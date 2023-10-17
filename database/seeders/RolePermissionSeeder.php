<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $read= Permission::create(['name' => 'read:files']);
        $upload = Permission::create(['name' => 'upload:files']);
        $delete =  $Permission::create(['name' => 'delete:files']);

    }
}
