<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'=>'Admin',
                'email'=>'admin@mail.com',
                'password'=>bcrypt('password')
            ],
            [
                'name'=>'Moderator',
                'email'=>'moderator@mail.com',
                'password'=>bcrypt('password')
            ],
            [
                'name'=>'John Doe',
                'email'=>'moderator@mail.com',
                'password'=>bcrypt('password')
            ],
            [
                'name'=>'Julia Louis',
                'email'=>'julia@mail.com',
                'password'=>bcrypt('password')
            ],
            [
                'name'=>'Sarah White',
                'email'=>'sarah@mail.com',
                'password'=>bcrypt('password')
            ],
            [
                'name'=>'Alex Patterson',
                'email'=>'alex@mail.com',
                'password'=>bcrypt('password')
            ],
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
