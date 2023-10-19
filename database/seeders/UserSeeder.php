<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = Role::create(['name'=>'admin']);
        $moderator_role = Role::create(['name'=>'moderator']);
        $user_role = Role::create(['name'=>'user']);

        $users = [
            [
                [
                    'name'=>'Admin',
                    'email'=>'admin@mail.com',
                    'password'=>bcrypt('password'),
                ],
                ['role_id'=>$admin_role->id],
            ],
            [
                [
                    'name'=>'Moderator',
                    'email'=>'moderator@mail.com',
                    'password'=>bcrypt('password')
                ],
                ['role_id'=>$moderator_role->id],
            ],
            [
                [
                    'name'=>'John Doe',
                    'email'=>'john@mail.com',
                    'password'=>bcrypt('password')
                ],
                ['role_id'=>$user_role->id],
            ],
            [
                [
                    'name'=>'Julia Louis',
                    'email'=>'julia@mail.com',
                    'password'=>bcrypt('password')
                ],
                ['role_id'=>$user_role->id],
            ],
            [
                [
                    'name'=>'Sarah White',
                    'email'=>'sarah@mail.com',
                    'password'=>bcrypt('password')
                ],
                ['role_id'=>$user_role->id],
            ],
            [
                [
                    'name'=>'Alex Patterson',
                    'email'=>'alex@mail.com',
                    'password'=>bcrypt('password')
                ],
                ['role_id'=>$user_role->id],
            
            ],
        ];

        foreach ($users as $user){
            $created_user = User::create($user[0]);
            $created_user->assignRole($user[1]['role_id']);
        }
    }
}
