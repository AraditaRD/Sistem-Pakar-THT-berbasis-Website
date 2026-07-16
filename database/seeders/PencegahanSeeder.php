<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penyakit;

class PencegahanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            'P001' => [
                'Hindari membersihkan telinga dengan cotton bud terlalu dalam',
                'Jangan memasukkan benda asing ke dalam telinga',
                'Bersihkan bagian luar telinga secara rutin',
                'Periksa telinga secara berkala jika produksi serumen berlebihan',
                'Konsultasikan ke dokter THT bila sering mengalami sumbatan telinga',
            ],

            'P002' => [
                'Cuci tangan secara teratur',
                'Hindari kontak dengan penderita flu',
                'Jaga daya tahan tubuh dengan pola hidup sehat',
                'Gunakan masker saat berada di lingkungan berdebu',
                'Istirahat yang cukup',
            ],

            'P003' => [
                'Menjaga kebersihan tangan',
                'Hindari berbagi alat makan dan minum',
                'Perbanyak konsumsi air putih',
                'Hindari merokok dan asap rokok',
                'Konsumsi makanan bergizi untuk meningkatkan imun',
            ],

            'P004' => [
                'Jaga telinga tetap kering setelah berenang atau mandi',
                'Hindari mengorek telinga',
                'Gunakan pelindung telinga saat berenang jika diperlukan',
                'Hindari penggunaan earphone yang tidak bersih',
                'Segera obati iritasi atau luka pada telinga',
            ],

            'P005' => [
                'Imunisasi sesuai jadwal',
                'Hindari paparan asap rokok',
                'Berikan ASI eksklusif pada bayi',
                'Segera obati infeksi saluran pernapasan atas',
                'Menjaga kebersihan lingkungan',
            ],

            'P006' => [
                'Hindari paparan debu dan polusi',
                'Kelola alergi dengan baik',
                'Jaga kelembapan udara ruangan',
                'Berhenti merokok',
                'Segera obati infeksi saluran pernapasan',
            ],

            'P007' => [
                'Hindari memasukkan benda ke telinga',
                'Awasi anak saat bermain benda kecil',
                'Simpan benda kecil di tempat aman',
                'Edukasi anak tentang bahaya memasukkan benda ke telinga',
                'Gunakan pelindung telinga saat bekerja di lingkungan berisiko',
            ],

            'P008' => [
                'Hindari alergen dan iritan',
                'Jaga kebersihan rumah',
                'Gunakan masker saat berdebu',
                'Berhenti merokok',
                'Rutin membersihkan saluran hidung sesuai anjuran dokter',
            ],

            'P009' => [
                'Hindari merokok dan alkohol',
                'Perbanyak minum air putih',
                'Hindari makanan yang terlalu pedas atau panas',
                'Jaga kebersihan mulut dan gigi',
                'Segera obati infeksi saluran pernapasan berulang',
            ],

            'P010' => [
                'Jaga telinga tetap kering',
                'Hindari penggunaan cotton bud berlebihan',
                'Jangan berbagi alat pembersih telinga',
                'Bersihkan alat bantu dengar secara rutin',
                'Segera obati infeksi telinga yang ada',
            ],

            'P011' => [
                'Jauhkan benda kecil dari jangkauan anak',
                'Awasi anak saat bermain',
                'Edukasi anak untuk tidak memasukkan benda ke hidung',
                'Gunakan mainan sesuai usia',
                'Simpan baterai kancing dan benda kecil dengan aman',
            ],

            'P012' => [
                'Hindari gerakan kepala mendadak',
                'Gunakan alat pelindung kepala saat berolahraga',
                'Jaga kesehatan telinga bagian dalam',
                'Berhati-hati saat bangun dari posisi tidur',
                'Lakukan pemeriksaan jika sering mengalami pusing berputar',
            ],

            'P013' => [
                'Rajin mencuci tangan',
                'Hindari kontak dengan penderita infeksi tenggorokan',
                'Tidak berbagi alat makan dan minum',
                'Konsumsi makanan bergizi',
                'Istirahat yang cukup',
            ],

            'P014' => [
                'Menjaga kebersihan mulut dan gigi',
                'Mengobati tonsilitis akut secara tuntas',
                'Hindari asap rokok',
                'Tingkatkan daya tahan tubuh',
                'Periksa ke dokter jika infeksi sering kambuh',
            ],

            'P015' => [
                'Hindari alergen pemicu (debu, serbuk sari, bulu hewan)',
                'Gunakan masker saat membersihkan rumah',
                'Rutin membersihkan tempat tidur dan karpet',
                'Menjaga ventilasi rumah yang baik',
                'Konsultasi dan kontrol alergi secara berkala',
            ],

        ];

        foreach ($data as $kode => $pencegahan) {

            Penyakit::where('kode', $kode)->update([
                'pencegahan' => implode("\n", $pencegahan)
            ]);

        }
    }
}