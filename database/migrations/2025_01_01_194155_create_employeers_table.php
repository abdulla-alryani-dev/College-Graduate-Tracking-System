<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employeers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('location');
            $table->string('industry')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Establish the relationship to users table
            $table->timestamps();
            });


    }

    public function down(): void
    {
        Schema::dropIfExists('employeers');
    }
};
