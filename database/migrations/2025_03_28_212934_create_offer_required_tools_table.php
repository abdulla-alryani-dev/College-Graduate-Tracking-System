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
        Schema::create('offer_technical_tool', function (Blueprint $table) {
            $table->foreignId('offer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('technical_tool_id')->constrained()->cascadeOnDelete();
            $table->enum('proficiency_level', ['basic', 'intermediate', 'advanced', 'expert']);
            $table->boolean('is_mandatory')->default(true);
            $table->primary(['offer_id', 'technical_tool_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer_required_tools');
    }
};
