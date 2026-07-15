<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_konsultasi', function (Blueprint $table) {

            $table->decimal('cf_user',3,2)
                  ->default(0)
                  ->after('jawaban');

        });
    }

    public function down(): void
    {
        Schema::table('detail_konsultasi', function (Blueprint $table) {

            $table->dropColumn('cf_user');

        });
    }
};