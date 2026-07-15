<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('spesialisasi')->nullable()->after('role');
            $table->string('no_hp')->nullable()->after('spesialisasi');
            $table->date('tanggal_lahir')->nullable()->after('no_hp');
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif')->after('tanggal_lahir');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['spesialisasi', 'no_hp', 'tanggal_lahir', 'status']);
        });
    }
};