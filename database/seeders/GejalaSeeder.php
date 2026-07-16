<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GejalaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            // ===========================
            // TELINGA
            // ===========================
            ['kode'=>'G001','nama'=>'Penurunan pendengaran','kategori'=>'Telinga'],
            ['kode'=>'G002','nama'=>'Telinga terasa ketutup','kategori'=>'Telinga'],
            ['kode'=>'G003','nama'=>'Telinga nyeri','kategori'=>'Telinga'],
            ['kode'=>'G004','nama'=>'Telinga gatal','kategori'=>'Telinga'],
            ['kode'=>'G005','nama'=>'Telinga keluar cairan','kategori'=>'Telinga'],
            ['kode'=>'G006','nama'=>'Telinga berdengung','kategori'=>'Telinga'],
            ['kode'=>'G007','nama'=>'Pusing','kategori'=>'Telinga'],
            ['kode'=>'G008','nama'=>'Vertigo','kategori'=>'Telinga'],
            ['kode'=>'G009','nama'=>'Gangguan keseimbangan','kategori'=>'Telinga'],
            ['kode'=>'G010','nama'=>'Mual','kategori'=>'Telinga'],
            ['kode'=>'G011','nama'=>'Telinga terasa ada tekanan','kategori'=>'Telinga'],
            ['kode'=>'G012','nama'=>'Telinga terasa terbakar atau panas','kategori'=>'Telinga'],

            // ===========================
            // HIDUNG
            // ===========================
            ['kode'=>'G013','nama'=>'Pilek','kategori'=>'Hidung'],
            ['kode'=>'G014','nama'=>'Bersin-bersin','kategori'=>'Hidung'],
            ['kode'=>'G015','nama'=>'Hidung mampet','kategori'=>'Hidung'],
            ['kode'=>'G016','nama'=>'Dahi atau pipi sakit','kategori'=>'Hidung'],
            ['kode'=>'G017','nama'=>'Demam','kategori'=>'Hidung'],
            ['kode'=>'G018','nama'=>'Bau tak sedap dari lubang hidung','kategori'=>'Hidung'],

            // ===========================
            // TENGGOROKAN
            // ===========================
            ['kode'=>'G019','nama'=>'Sakit tenggorokan','kategori'=>'Tenggorokan'],
            ['kode'=>'G020','nama'=>'Nyeri saat menelan','kategori'=>'Tenggorokan'],
            ['kode'=>'G021','nama'=>'Batuk-batuk','kategori'=>'Tenggorokan'],
            ['kode'=>'G022','nama'=>'Suara serak','kategori'=>'Tenggorokan'],
            ['kode'=>'G023','nama'=>'Bau mulut','kategori'=>'Tenggorokan'],
            ['kode'=>'G024','nama'=>'Sakit perut','kategori'=>'Tenggorokan'],
            ['kode'=>'G025','nama'=>'Muncul bercak putih pada tonsil/amandel','kategori'=>'Tenggorokan'],
            ['kode'=>'G026','nama'=>'Tonsil/amandel yang membesar terus-menerus','kategori'=>'Tenggorokan'],

            // ===========================
            // KULIT
            // ===========================
            ['kode'=>'G027','nama'=>'Muncul ruam pada kulit','kategori'=>'Kulit'],
        ];

        foreach ($data as &$row) {
            $row['created_at'] = now();
            $row['updated_at'] = now();
        }

        DB::table('gejala')->insert($data);
    }
}