<?php
// database/seeders/EmployerSeeder.php
namespace Database\Seeders;

use App\Models\Employeer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployersSeeder extends Seeder
{
    public function run()
    {
        $employers = [
            [
                'name' => 'Tech Solutions Inc.',
                'email' => 'tech@example.com',
                'password' => Hash::make('password123'),
                'location' => 'San Francisco',
                'field' => 'Technology',
            ],
            [
                'name' => 'Healthcare Partners',
                'email' => 'health@example.com',
                'password' => Hash::make('password123'),
                'location' => 'New York',
                'field' => 'Healthcare',
            ],
            [
                'name' => 'Finance Experts LLC',
                'email' => 'finance@example.com',
                'password' => Hash::make('password123'),
                'location' => 'Chicago',
                'field' => 'Finance',
            ],
            [
                'name' => 'EduFuture Academy',
                'email' => 'edu@example.com',
                'password' => Hash::make('password123'),
                'location' => 'Boston',
                'field' => 'Education',
            ],
            [
                'name' => 'Manufacturing Pro',
                'email' => 'manufacturing@example.com',
                'password' => Hash::make('password123'),
                'location' => 'Detroit',
                'field' => 'Manufacturing',
            ],
            [
                'name' => 'Retail Masters',
                'email' => 'retail@example.com',
                'password' => Hash::make('password123'),
                'location' => 'Los Angeles',
                'field' => 'Retail',
            ],
            [
                'name' => 'Global Hospitality',
                'email' => 'hospitality@example.com',
                'password' => Hash::make('password123'),
                'location' => 'Las Vegas',
                'field' => 'Hospitality',
            ],
            [
                'name' => 'BuildRight Construction',
                'email' => 'construction@example.com',
                'password' => Hash::make('password123'),
                'location' => 'Houston',
                'field' => 'Construction',
            ],
            [
                'name' => 'Digital Marketing Pros',
                'email' => 'marketing@example.com',
                'password' => Hash::make('password123'),
                'location' => 'Austin',
                'field' => 'Marketing',
            ],
            [
                'name' => 'Remote Work Experts',
                'email' => 'remote@example.com',
                'password' => Hash::make('password123'),
                'location' => 'Remote',
                'field' => 'Technology',
            ],
        ];

        foreach ($employers as $employer) {
            Employeer::create($employer);
        }
    }
}
