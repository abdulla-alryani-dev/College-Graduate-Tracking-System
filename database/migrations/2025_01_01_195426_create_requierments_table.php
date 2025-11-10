<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('requierments', function (Blueprint $table) {
            $table->id();
            $table->string('technology');
            $table->foreignId('offer_id')->constrained('offers');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('requierments');
    }
};
