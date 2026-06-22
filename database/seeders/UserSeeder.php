<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [


            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => 'SuperAdmin@123',
                'role_id' => 1,
                'parent' => null,
            ],


            [
                'name' => 'Sembark Tech',
                'email' => 'sembark@tech.com',
                'password' => 'Admin1@123',
                'role_id' => 2,
                'parent' => 1,
            ],
            [
                'name' => 'Zerfinis Solutions',
                'email' => 'zerfinis@solutions.com',
                'password' => 'Admin2@123',
                'role_id' => 2,
                'parent' => 1,
            ],
            [
                'name' => 'ASP Corp',
                'email' => 'asp@corp.com',
                'password' => 'Admin3@123',
                'role_id' => 2,
                'parent' => 1,
            ],


            [
                'name' => 'Member1A',
                'email' => 'member1a@gmail.com',
                'password' => 'Member1a@123',
                'role_id' => 3,
                'parent' => 2,
            ],
            [
                'name' => 'Member1B',
                'email' => 'member1b@gmail.com',
                'password' => 'Member1b@123',
                'role_id' => 3,
                'parent' => 2,
            ],


            [
                'name' => 'Member2A',
                'email' => 'member2a@gmail.com',
                'password' => 'Member2a@123',
                'role_id' => 3,
                'parent' => 3,
            ],


            [
                'name' => 'Member3B',
                'email' => 'member3b@gmail.com',
                'password' => 'Member3b@123',
                'role_id' => 3,
                'parent' => 4,
            ],
        ];

        foreach ($users as $user) {

            User::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role_id' => $user['role_id'],
                    'parent' => $user['parent'],
                ]
            );
        }
    }
}
