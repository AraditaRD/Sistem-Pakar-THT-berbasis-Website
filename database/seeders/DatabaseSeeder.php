<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Matikan foreign key check sementara biar bisa truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('rules')->truncate();
        DB::table('detail_konsultasi')->truncate();
        DB::table('hasil_diagnosa')->truncate();
        DB::table('konsultasi')->truncate();
        DB::table('gejala')->truncate();
        DB::table('penyakit')->truncate();
        DB::table('users')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call([
            UserSeeder::class,
            PenyakitSeeder::class,
            GejalaSeeder::class,
            RuleSeeder::class,
        ]);
    }
}