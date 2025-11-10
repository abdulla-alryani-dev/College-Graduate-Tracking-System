<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('university_data', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('full_name');
            $table->string('sex');
            $table->string('major');
            $table->float('GPA');
            $table->boolean('honours_degree');
            $table->year('graduation_year');
            $table->string('personal_email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('university_data');
    }
};
