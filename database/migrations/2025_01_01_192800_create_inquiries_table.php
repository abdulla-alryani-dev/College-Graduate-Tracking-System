<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->longText('description');
            $table->longText('respond');
            $table->foreignId('graduate_id')->constrained('graduates');
            $table->foreignId('division_id')->constrained('divisions');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
    }
    
};
