<?php

// database/seeders/OffersSeeder.php
namespace Database\Seeders;

use App\Models\Offer;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OffersSeeder extends Seeder
{
    public function run()
    {
        $jobTitles = [
            'Laravel Developer',
            'Full Stack Developer',
            'Backend Engineer',
            'Frontend Developer',
            'DevOps Specialist',
            'JavaScript Engineer',
            'PHP Developer',
            'React Specialist',
            'Database Administrator',
            'Cloud Architect'
        ];

        $jobTypes = ['full-time', 'part-time', 'contract', 'freelance', 'internship'];
        $experienceLevels = ['entry', 'mid', 'senior', 'executive'];

        for ($i = 0; $i < 20; $i++) {
            Offer::create([
                'employeer_id' => rand(1, 10), // Assuming you have 10 employers
                'job_title' => $jobTitles[array_rand($jobTitles)],
                'job_description' => 'We are looking for a skilled professional to join our team. ' .
                    'The ideal candidate will have experience in various technologies ' .
                    'and a passion for software development.',
                'location' => ['Remote', 'New York', 'San Francisco', 'London', 'Berlin'][array_rand([0,1,2,3,4])],
                'job_type' => $jobTypes[array_rand($jobTypes)],
                'experience_level' => $experienceLevels[array_rand($experienceLevels)],
                'expiration_date' => Carbon::now()->addDays(rand(30, 90)),
                'is_active' => rand(0, 1)
            ]);
        }
    }
}
