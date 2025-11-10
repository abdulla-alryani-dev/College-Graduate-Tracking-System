<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@alumni.edu',
            'password' => Hash::make('password'),
            'phone' => '1234567890',
            'status' => 'approved'
        ]);
        $admin->assignRole('admin');

        // Graduate users
        for ($i = 1; $i <= 10; $i++) {
            $graduate = User::create([
                'name' => "Graduate $i",
                'email' => "graduate$i@alumni.edu",
                'password' => Hash::make('password'),
                'phone' => '123456789' . $i,
                'status' => 'approved'
            ]);
            $graduate->assignRole('graduate');
        }

        // Employer users
        for ($i = 1; $i <= 5; $i++) {
            $employer = User::create([
                'name' => "Employer $i",
                'email' => "employer$i@company.com",
                'password' => Hash::make('password'),
                'phone' => '987654321' . $i,
                'status' => 'approved'
            ]);
            $employer->assignRole('employer');
        }

        // Division users
        $divisions = ['IT', 'Career Services', 'Alumni Relations', 'Academic Affairs'];
        foreach ($divisions as $division) {
            $user = User::create([
                'name' => "$division Division",
                'email' => strtolower(str_replace(' ', '', $division)) . "@alumni.edu",
                'password' => Hash::make('password'),
                'phone' => '5555555555',
                'status' => 'approved'
            ]);
            $user->assignRole('division');
        }
    }
}
