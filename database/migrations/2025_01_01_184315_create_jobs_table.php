<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
//        Schema::dropIfExists('jobs');
//        Schema::dropIfExists('job_batches');
//        Schema::dropIfExists('failed_jobs');

        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('compony');
            $table->string('location');
            $table->string('field_of_work');
            $table->string('technology');
            $table->integer('created_by')->unsigned()->nullable()->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
