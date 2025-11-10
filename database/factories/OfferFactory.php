<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\Employeer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OfferFactory extends Factory
{
    protected $model = Offer::class;

    public function definition(): array
    {
        $salaryType = $this->faker->randomElement(['fixed', 'range']);

        return [
            'employeer_id' => '1', // or existing ID
            'job_title' => $this->faker->jobTitle(),
            'job_description' => $this->faker->paragraph(4),
            'location' => $this->faker->city(),
            'job_type' => $this->faker->randomElement(['دوام كامل', 'دوام جزئي', 'عقد', 'عمل حر', 'تدريب']),
            'experience_level' => $this->faker->randomElement([
                'مبتدئ (0-2 سنة)',
                'متوسط (2-5 سنوات)',
                'خبير (5-10 سنوات)',
                'قائد/إداري (+10 سنوات)'
            ]),
            'expiration_date' => $this->faker->dateTimeBetween('+1 month', '+6 months'),
            'is_active' => $this->faker->boolean(85),
            'job_category' => $this->faker->randomElement(['تطوير برمجيات', 'موارد بشرية', 'مالية', 'تصميم', 'تسويق']),
            'location_type' => $this->faker->randomElement(['حضوري', 'عن بعد', 'مختلط']),
            'vacancies' => $this->faker->numberBetween(1, 10),
            'salary_type' => $salaryType,

            // Fixed salary fields
            'fixed_salary' => $salaryType === 'fixed' ? $this->faker->numberBetween(3000, 10000) : null,
            'fixed_salary_currency' => $salaryType === 'fixed' ? 'SAR' : null,
            'fixed_salary_period' => $salaryType === 'fixed' ? 'شهري' : null,

            // Salary range fields
            'salary_min' => $salaryType === 'range' ? $this->faker->numberBetween(2000, 5000) : null,
            'salary_max' => $salaryType === 'range' ? $this->faker->numberBetween(6000, 10000) : null,
            'salary_range_currency' => $salaryType === 'range' ? 'SAR' : null,
            'salary_range_period' => $salaryType === 'range' ? 'شهري' : null,

            // Optional
            'qualifications' => $this->faker->sentence(8),
            'application_instructions' => 'أرسل سيرتك الذاتية إلى: ' . $this->faker->email(),
            'additional_info' => $this->faker->optional()->sentence(),
        ];
    }
}
