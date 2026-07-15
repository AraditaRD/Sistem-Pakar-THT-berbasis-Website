<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenyakitSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kode'      => 'P001',
                'nama'      => 'Tonsilitis',
                'deskripsi' => 'Peradangan pada tonsil (amandel) yang menyebabkan nyeri tenggorokan.',
                'penyebab'  => 'Infeksi bakteri atau virus.',
                'solusi'    => 'Antibiotik, pereda nyeri, istirahat. Operasi jika kronis.',
                'created_at'=> now(), 'updated_at' => now(),
            ],
            [
                'kode'      => 'P002',
                'nama'      => 'Otitis Eksternal',
                'deskripsi' => 'Infeksi pada saluran telinga luar.',
                'penyebab'  => 'Bakteri, jamur, iritasi.',
                'solusi'    => 'Tetes telinga antibiotik, hindari air masuk telinga.',
                'created_at'=> now(), 'updated_at' => now(),
            ],
            [
                'kode'      => 'P003',
                'nama'      => 'Tinnitus',
                'deskripsi' => 'Persepsi suara denging atau berdesing di telinga tanpa sumber eksternal.',
                'penyebab'  => 'Kerusakan sel rambut telinga, paparan kebisingan.',
                'solusi'    => 'Terapi suara, konseling, hindari kebisingan.',
                'created_at'=> now(), 'updated_at' => now(),
            ],
            [
                'kode'      => 'P004',
                'nama'      => 'Rhinitis Alergi',
                'deskripsi' => 'Peradangan selaput hidung akibat reaksi alergi.',
                'penyebab'  => 'Debu, serbuk sari, bulu hewan.',
                'solusi'    => 'Antihistamin, hindari alergen, cuci hidung dengan saline.',
                'created_at'=> now(), 'updated_at' => now(),
            ],
            [
                'kode'      => 'P005',
                'nama'      => 'Sinusitis Akut',
                'deskripsi' => 'Peradangan pada rongga sinus yang menyebabkan nyeri wajah.',
                'penyebab'  => 'Infeksi bakteri atau virus setelah flu.',
                'solusi'    => 'Dekongestan, antibiotik jika bakteri, kompres hangat.',
                'created_at'=> now(), 'updated_at' => now(),
            ],
            [
                'kode'      => 'P006',
                'nama'      => 'Faringitis Virus',
                'deskripsi' => 'Peradangan pada faring yang disebabkan oleh infeksi virus.',
                'penyebab'  => 'Virus seperti rhinovirus atau adenovirus.',
                'solusi'    => 'Istirahat, minum banyak cairan, berkumur air garam hangat.',
                'created_at'=> now(), 'updated_at' => now(),
            ],
            [
                'kode'      => 'P007',
                'nama'      => 'Laringitis',
                'deskripsi' => 'Peradangan pada laring yang menyebabkan suara serak atau hilang.',
                'penyebab'  => 'Infeksi virus, penggunaan suara berlebihan, iritasi.',
                'solusi'    => 'Istirahat suara, hindari asap rokok, minum air hangat.',
                'created_at'=> now(), 'updated_at' => now(),
            ],
            [
                'kode'      => 'P008',
                'nama'      => 'Vertigo (BPPV)',
                'deskripsi' => 'Gangguan keseimbangan akibat masalah di telinga dalam.',
                'penyebab'  => 'Pergeseran kristal kalsium di telinga dalam.',
                'solusi'    => 'Manuver Epley, fisioterapi vestibular.',
                'created_at'=> now(), 'updated_at' => now(),
            ],
        ];

        DB::table('penyakit')->insert($data);
    }
}