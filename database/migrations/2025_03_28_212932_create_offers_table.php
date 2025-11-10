<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // database/migrations/YYYY_MM_DD_create_offers_table.php
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employeer_id')->constrained()->cascadeOnDelete();
            $table->string('job_title');
            $table->text('job_description');
            $table->string('location')->nullable();
            $table->enum('job_type', ['دوام كامل', 'دوام جزئي', 'عقد', 'عمل حر', 'تدريب']);
            $table->enum('experience_level', [
                'مبتدئ (0-2 سنة)',
                'متوسط (2-5 سنوات)',
                'خبير (5-10 سنوات)',
                'قائد/إداري (+10 سنوات)'
            ]);
            $table->date('expiration_date');
            $table->boolean('is_active')->default(true);
            $table->string('job_category');
            $table->string('location_type');
            $table->unsignedInteger('vacancies');
            $table->string('salary_type');
            // Fixed salary fields
            $table->decimal('fixed_salary', 10, 2)->nullable();
            $table->char('fixed_salary_currency', 3)->nullable();
            $table->string('fixed_salary_period')->nullable();
            // Salary range fields
            $table->decimal('salary_min', 10, 2)->nullable();
            $table->decimal('salary_max', 10, 2)->nullable();
            $table->char('salary_range_currency', 3)->nullable();
            $table->string('salary_range_period')->nullable();
            // Additional fields
            $table->text('qualifications')->nullable();
            $table->text('application_instructions')->nullable();
            $table->text('additional_info')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
