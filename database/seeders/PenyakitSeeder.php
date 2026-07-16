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
                'kode' => 'P001',
                'nama' => 'Cerumen Impacted',
                'deskripsi' => 'Penumpukan serumen (kotoran telinga) yang menghambat liang telinga sehingga menyebabkan telinga terasa penuh, pendengaran menurun, atau nyeri.',
                'penyebab' => 'Produksi serumen berlebihan, penggunaan cotton bud yang mendorong serumen ke dalam, penggunaan earphone atau alat bantu dengar, bentuk liang telinga yang sempit, penumpukan serumen yang tidak keluar secara alami.',
                'solusi' => 'Hindari mengorek telinga menggunakan cotton bud atau benda tajam. Jaga telinga tetap kering dan segera periksa ke dokter THT apabila pendengaran menurun, nyeri, atau telinga terasa tersumbat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P002',
                'nama' => 'Rhinitis Akut',
                'deskripsi' => 'Peradangan pada mukosa hidung yang umumnya disebabkan infeksi virus sehingga menimbulkan pilek, hidung tersumbat, dan bersin.',
                'penyebab' => 'Infeksi virus (rhinovirus, coronavirus, influenza), paparan udara dingin, daya tahan tubuh menurun, kontak dengan penderita flu, iritasi debu atau polusi.',
                'solusi' => 'Perbanyak istirahat, minum air putih yang cukup, hindari debu dan asap rokok, serta gunakan larutan saline untuk membantu membersihkan hidung.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P003',
                'nama' => 'Faringitis Akut',
                'deskripsi' => 'Peradangan pada faring (tenggorokan) yang menyebabkan nyeri saat menelan, tenggorokan merah, dan demam.',
                'penyebab' => 'Infeksi virus (influenza, adenovirus), infeksi bakteri (Streptococcus pyogenes), paparan asap rokok, alergi, udara kering.',
                'solusi' => 'Perbanyak minum air hangat, berkumur dengan air garam hangat beberapa kali sehari, istirahat yang cukup, dan hindari makanan atau minuman yang terlalu panas maupun terlalu dingin.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P004',
                'nama' => 'Otitis Eksterna',
                'deskripsi' => 'Peradangan atau infeksi pada liang telinga bagian luar yang umumnya disebabkan oleh bakteri, jamur, atau kelembapan berlebih pada telinga.',
                'penyebab' => 'Infeksi bakteri atau jamur pada liang telinga, kelembapan berlebih akibat berenang, trauma karena mengorek telinga, penggunaan earphone yang tidak bersih, iritasi bahan kimia.',
                'solusi' => 'Jaga telinga tetap kering, hindari berenang sementara waktu, jangan mengorek telinga, dan hindari penggunaan earphone sampai keluhan membaik.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P005',
                'nama' => 'Otitis Media Akut',
                'deskripsi' => 'Infeksi pada telinga tengah yang sering terjadi setelah infeksi saluran pernapasan atas.',
                'penyebab' => 'Infeksi bakteri atau virus pada telinga tengah, infeksi saluran pernapasan atas, disfungsi tuba eustachius, alergi, paparan asap rokok.',
                'solusi' => 'Istirahat yang cukup, minum air putih, hindari asap rokok, dan jangan memasukkan benda apa pun ke dalam telinga. Segera ke dokter bila nyeri berat atau keluar cairan dari telinga.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P006',
                'nama' => 'Sinusitis Kronis',
                'deskripsi' => 'Peradangan pada rongga sinus yang berlangsung lebih dari 12 minggu.',
                'penyebab' => 'Infeksi sinus berulang, alergi yang tidak terkontrol, polip hidung, kelainan struktur hidung, paparan polusi dan asap rokok.',
                'solusi' => 'Gunakan larutan saline untuk membilas hidung, perbanyak minum air putih, hindari paparan debu dan asap rokok, serta istirahat yang cukup.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P007',
                'nama' => 'Corpus Alienum Telinga',
                'deskripsi' => 'Masuknya benda asing ke telinga secara sengaja maupun tidak sengaja yang menyebabkan nyeri, gangguan pendengaran, atau infeksi.',
                'penyebab' => 'Masuknya benda asing ke telinga secara sengaja atau tidak sengaja, terutama pada anak-anak, serangga yang masuk ke liang telinga, kecelakaan saat bermain.',
                'solusi' => 'Jangan mencoba mengeluarkan benda asing menggunakan pinset, cotton bud, atau benda lain. Miringkan kepala bila memungkinkan dan segera periksa ke fasilitas kesehatan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P008',
                'nama' => 'Rhinitis Kronis',
                'deskripsi' => 'Peradangan hidung yang berlangsung lama sehingga menyebabkan hidung tersumbat, pilek, atau bersin terus-menerus.',
                'penyebab' => 'Paparan alergen berkepanjangan, polusi udara, asap rokok, infeksi berulang, penggunaan obat semprot hidung berlebihan.',
                'solusi' => 'Hindari alergen atau pemicu seperti debu dan asap rokok, gunakan saline untuk membersihkan hidung, serta jaga kebersihan lingkungan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P009',
                'nama' => 'Faringitis Kronis',
                'deskripsi' => 'Peradangan pada tenggorokan yang berlangsung lama atau sering kambuh sehingga menimbulkan rasa tidak nyaman dan nyeri saat menelan.',
                'penyebab' => 'Iritasi tenggorokan jangka panjang akibat merokok, polusi udara, refluks asam lambung (GERD), infeksi berulang, konsumsi alkohol berlebihan.',
                'solusi' => 'Perbanyak minum air putih, hindari merokok, alkohol, makanan pedas, dan iritan lainnya. Bila memiliki riwayat asam lambung, usahakan mengontrol pola makan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P010',
                'nama' => 'Otomikosis',
                'deskripsi' => 'Infeksi jamur pada liang telinga yang menyebabkan gatal, nyeri, telinga terasa penuh, dan kadang keluar cairan.',
                'penyebab' => 'Infeksi jamur (Aspergillus atau Candida), telinga yang lembap, penggunaan antibiotik jangka panjang, kebiasaan mengorek telinga, daya tahan tubuh menurun.',
                'solusi' => 'Jaga telinga tetap kering, jangan mengorek telinga, hindari penggunaan earphone sementara, dan segera konsultasikan ke dokter untuk mendapatkan terapi yang sesuai.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P011',
                'nama' => 'Corpus Alienum Hidung',
                'deskripsi' => 'Masuknya benda asing ke dalam rongga hidung yang menyebabkan hidung tersumbat, nyeri, atau keluar cairan berbau.',
                'penyebab' => 'Masuknya benda asing ke dalam hidung, terutama pada anak-anak, kebiasaan memasukkan benda kecil ke hidung, kurangnya pengawasan saat bermain.',
                'solusi' => 'Jangan mencoba mengambil benda asing menggunakan alat atau jari karena dapat mendorong benda semakin dalam. Segera periksa ke dokter atau fasilitas kesehatan agar benda asing dapat dikeluarkan dengan aman.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P012',
                'nama' => 'BPPV',
                'deskripsi' => 'Gangguan keseimbangan yang menyebabkan sensasi berputar akibat perubahan posisi kepala karena gangguan pada telinga bagian dalam.',
                'penyebab' => 'Perpindahan kristal kalsium (otolith) di telinga bagian dalam, cedera kepala, proses penuaan, infeksi telinga dalam, atau riwayat operasi telinga.',
                'solusi' => 'Hindari perubahan posisi kepala secara tiba-tiba, duduk atau berbaring saat pusing muncul, dan lakukan pemeriksaan ke dokter untuk mendapatkan terapi seperti manuver reposisi bila diperlukan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P013',
                'nama' => 'Tonsilitis Akut',
                'deskripsi' => 'Peradangan akut pada tonsil (amandel) yang menyebabkan nyeri tenggorokan, demam, dan kesulitan menelan.',
                'penyebab' => 'Infeksi virus (influenza, adenovirus, Epstein-Barr), infeksi bakteri (Streptococcus pyogenes), kontak dengan penderita infeksi, dan daya tahan tubuh yang menurun.',
                'solusi' => 'Perbanyak minum air hangat, istirahat yang cukup, berkumur dengan air garam hangat, konsumsi makanan lunak, dan segera periksa ke dokter apabila keluhan semakin berat.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P014',
                'nama' => 'Tonsilitis Kronis',
                'deskripsi' => 'Peradangan tonsil yang berlangsung lama atau sering kambuh sehingga mengganggu aktivitas sehari-hari.',
                'penyebab' => 'Infeksi tonsil berulang yang tidak sembuh sempurna, bakteri yang menetap pada tonsil, kebersihan mulut yang kurang baik, dan daya tahan tubuh yang rendah.',
                'solusi' => 'Menjaga kebersihan mulut, memperbanyak minum air putih, menghindari rokok serta iritan, dan berkonsultasi ke dokter THT apabila infeksi sering kambuh untuk mempertimbangkan terapi lebih lanjut.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'kode' => 'P015',
                'nama' => 'Rhinitis Alergi',
                'deskripsi' => 'Peradangan pada mukosa hidung akibat reaksi alergi terhadap alergen tertentu yang menyebabkan bersin, pilek, hidung tersumbat, dan hidung gatal.',
                'penyebab' => 'Reaksi alergi terhadap debu, tungau, serbuk sari, bulu hewan, jamur, atau alergen lain yang memicu respons sistem imun.',
                'solusi' => 'Hindari paparan alergen seperti debu, tungau, bulu hewan, dan serbuk sari, gunakan masker saat membersihkan rumah, serta lakukan pemeriksaan ke dokter bila keluhan sering berulang.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('penyakit')->insert($data);
    }
}