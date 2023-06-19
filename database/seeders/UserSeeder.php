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
        $password = bcrypt('password');

        $users = [
            [
                'id' => 1,
                'name' => 'Administrator',
                'email' => 'admin@mail.com',
                'username' => 'admin',
                'password' => $password,
            ],
            [
                'id' => 2,
                'name' => 'Member',
                'email' => 'member@mail.com',
                'username' => 'member',
                'password' => $password,
            ],
        ];

        User::insert($users);
    }
}
