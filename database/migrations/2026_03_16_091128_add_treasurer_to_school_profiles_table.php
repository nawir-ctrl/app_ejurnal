<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->string('principal_nip')->nullable()->after('principal_name');
            $table->string('treasurer_name')->nullable()->after('principal_nip');
            $table->string('treasurer_nip')->nullable()->after('treasurer_name');
        });
    }

    public function down(): void {
        Schema::table('school_profiles', function (Blueprint $table) {
            $table->dropColumn(['principal_nip', 'treasurer_name', 'treasurer_nip']);
        });
    }
};