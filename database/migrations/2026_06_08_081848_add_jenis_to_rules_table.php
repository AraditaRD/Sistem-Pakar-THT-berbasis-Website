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
            Schema::table('rules', function (Blueprint $table) {
                $table->enum('jenis', ['wajib', 'pendukung'])
                    ->default('pendukung')
                    ->after('gejala_id');
            });
        }

    /**
     * Reverse the migrations.
     */
            public function down(): void
        {
            Schema::table('rules', function (Blueprint $table) {
                $table->dropColumn('jenis');
            });
        }
};