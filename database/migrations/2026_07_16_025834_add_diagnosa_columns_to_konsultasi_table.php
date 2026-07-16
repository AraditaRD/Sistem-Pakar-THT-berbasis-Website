<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('konsultasi', function (Blueprint $table) {

            $table->foreignId('penyakit_id')
                ->nullable()
                ->after('status')
                ->constrained('penyakit')
                ->cascadeOnDelete();

            $table->decimal('persentase', 5, 2)
                ->default(0)
                ->after('penyakit_id');

        });
    }

    public function down(): void
    {
        Schema::table('konsultasi', function (Blueprint $table) {

            $table->dropForeign(['penyakit_id']);

            $table->dropColumn([
                'penyakit_id',
                'persentase',
            ]);

        });
    }
};