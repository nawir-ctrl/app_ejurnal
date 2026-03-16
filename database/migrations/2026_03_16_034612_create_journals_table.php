<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('journals', function (Blueprint $table) {
        $table->id();
        $table->date('date');
        $table->foreignId('teacher_id')->constrained()->cascadeOnDelete();
        $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
        $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
        $table->string('time_slot'); 
        $table->text('material');
        $table->string('method');
        $table->text('attendance')->nullable(); 
        $table->text('notes')->nullable();
        $table->string('photo_path')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
