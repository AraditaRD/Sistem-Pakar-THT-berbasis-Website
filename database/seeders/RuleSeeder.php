<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuleSeeder extends Seeder
{
    public function run(): void
    {
        // [kode, penyakit_id, gejala_id]
        $rules = [
            // P001 - Tonsilitis
            ['R001', 1, 16],
            ['R001', 1, 17],
            ['R001', 1, 18],
            ['R001', 1, 19],
            ['R001', 1, 23],

            // P002 - Otitis Eksternal
            ['R002', 2,  1],
            ['R002', 2,  5],
            ['R002', 2,  4],

            // P003 - Tinnitus
            ['R003', 3,  2],
            ['R003', 3,  3],

            // P004 - Rhinitis Alergi
            ['R004', 4,  9],
            ['R004', 4, 10],
            ['R004', 4, 11],
            ['R004', 4, 12],

            // P005 - Sinusitis Akut
            ['R005', 5,  9],
            ['R005', 5, 13],
            ['R005', 5, 14],
            ['R005', 5, 15],
            ['R005', 5, 23],

            // P006 - Faringitis Virus
            ['R006', 6, 16],
            ['R006', 6, 22],
            ['R006', 6, 23],

            // P007 - Laringitis
            ['R007', 7, 20],
            ['R007', 7, 21],
            ['R007', 7, 16],

            // P008 - Vertigo BPPV
            ['R008', 8,  7],
            ['R008', 8,  8],
            ['R008', 8,  3],
        ];

        foreach ($rules as $r) {
            DB::table('rules')->insert([
                'kode'        => $r[0],
                'penyakit_id' => $r[1],
                'gejala_id'   => $r[2],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}