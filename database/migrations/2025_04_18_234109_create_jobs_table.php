<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Job;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->unsignedInteger('salary');
            $table->string('location');
            $table->string('category');
            $table->enum('experience', Job::$experience);
            $table->enum('status', Job::$status)->default('open');
            $table->enum('work_modes', Job::$work_modes)->default('onsite');
            $table->string('company_name')->nullable();
            $table->date('expires_at')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('applications')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
