<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GejalaSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Telinga
            ['kode'=>'G001','nama'=>'Nyeri telinga',              'kategori'=>'Telinga'],
            ['kode'=>'G002','nama'=>'Telinga berdenging',         'kategori'=>'Telinga'],
            ['kode'=>'G003','nama'=>'Gangguan pendengaran',       'kategori'=>'Telinga'],
            ['kode'=>'G004','nama'=>'Keluar cairan dari telinga', 'kategori'=>'Telinga'],
            ['kode'=>'G005','nama'=>'Telinga gatal',              'kategori'=>'Telinga'],
            ['kode'=>'G006','nama'=>'Telinga terasa penuh',       'kategori'=>'Telinga'],
            ['kode'=>'G007','nama'=>'Pusing berputar',            'kategori'=>'Telinga'],
            ['kode'=>'G008','nama'=>'Mual saat bergerak kepala',  'kategori'=>'Telinga'],

            // Hidung
            ['kode'=>'G009','nama'=>'Hidung tersumbat',           'kategori'=>'Hidung'],
            ['kode'=>'G010','nama'=>'Bersin-bersin',              'kategori'=>'Hidung'],
            ['kode'=>'G011','nama'=>'Hidung berair (encer)',      'kategori'=>'Hidung'],
            ['kode'=>'G012','nama'=>'Mata gatal atau berair',     'kategori'=>'Hidung'],
            ['kode'=>'G013','nama'=>'Nyeri wajah atau pipi',      'kategori'=>'Hidung'],
            ['kode'=>'G014','nama'=>'Lendir hidung kuning/hijau', 'kategori'=>'Hidung'],
            ['kode'=>'G015','nama'=>'Sakit kepala',               'kategori'=>'Hidung'],

            // Tenggorokan
            ['kode'=>'G016','nama'=>'Sakit tenggorokan',           'kategori'=>'Tenggorokan'],
            ['kode'=>'G017','nama'=>'Sulit menelan',               'kategori'=>'Tenggorokan'],
            ['kode'=>'G018','nama'=>'Amandel membesar',            'kategori'=>'Tenggorokan'],
            ['kode'=>'G019','nama'=>'Bercak putih di tenggorokan', 'kategori'=>'Tenggorokan'],
            ['kode'=>'G020','nama'=>'Suara serak',                 'kategori'=>'Tenggorokan'],
            ['kode'=>'G021','nama'=>'Kehilangan suara',            'kategori'=>'Tenggorokan'],
            ['kode'=>'G022','nama'=>'Batuk',                       'kategori'=>'Tenggorokan'],
            ['kode'=>'G023','nama'=>'Demam',                       'kategori'=>'Tenggorokan'],
        ];

        foreach ($data as &$row) {
            $row['created_at'] = now();
            $row['updated_at'] = now();
        }

        DB::table('gejala')->insert($data);
    }
}