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
    Schema::create('school_profiles', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('npsn', 20)->nullable();
        $table->text('address')->nullable();
        $table->string('principal_name')->nullable();
        $table->string('logo_path')->nullable();
        $table->string('academic_year', 20)->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_profiles');
    }
};
