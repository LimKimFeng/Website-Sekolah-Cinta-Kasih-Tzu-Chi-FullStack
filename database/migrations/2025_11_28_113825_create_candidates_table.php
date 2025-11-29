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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('registration_number')->unique();
            $table->enum('level', ['TK', 'SD', 'SMP', 'SMA', 'SMK']);
            $table->enum('major', ['PPLG', 'AKL', 'MPLB'])->nullable();
            $table->enum('status', ['draft', 'submitted', 'verified', 'accepted', 'rejected'])->default('draft');
            $table->dateTime('exam_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
