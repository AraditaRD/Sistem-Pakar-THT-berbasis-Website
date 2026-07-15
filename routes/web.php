<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Pakar\GejalaController;
use App\Http\Controllers\Pasien\DiagnosaController;
use App\Http\Controllers\Pakar\PenyakitController;
use App\Http\Controllers\Pakar\AturanController;
use App\Http\Controllers\Pakar\PasienController;
use App\Http\Controllers\Pakar\RiwayatController;
use App\Http\Controllers\Pakar\PakarController;
use App\Http\Controllers\Pakar\DashboardController;

// LANDING PAGE
    Route::get('/', fn() => view('landing'))->name('landing');

// AUTH PAKAR
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])
    ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
    ->name('register.post');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// PASIEN
    Route::middleware(['auth','role:pasien'])
    ->prefix('pasien')
    ->name('pasien.')
    ->group(function () {

    Route::get('/dashboard', fn() => view('pasien.dashboard'))->name('dashboard');
    Route::get('/diagnosa', [DiagnosaController::class,'index'])
        ->name('diagnosa');
    Route::post('/diagnosa/simpan', [DiagnosaController::class,'store'])
        ->name('diagnosa.store');
    Route::get('/hasil', [DiagnosaController::class,'hasil'])
    ->name('hasil');
    Route::get('/riwayat', [DiagnosaController::class,'riwayat'])
    ->name('riwayat');
    Route::get('/riwayat/{id}', [DiagnosaController::class,'detail']
    )->name('riwayat.detail');
    Route::get('/informasi',
    [DiagnosaController::class,'informasi'])
    ->name('informasi');
});

// PAKAR
    Route::middleware(['auth', 'role:pakar'])->prefix('pakar')->name('pakar.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');
    Route::get('/gejala', [GejalaController::class, 'index'])->name('gejala');
    Route::post('/gejala/store', [GejalaController::class, 'store'])
    ->name('gejala.store');
    Route::delete('/gejala/{id}', [GejalaController::class, 'destroy'])
    ->name('gejala.destroy');
    Route::put('/gejala/{id}', [GejalaController::class, 'update'])
    ->name('gejala.update');
    Route::get('/aturan', [AturanController::class,'index'])->name('aturan');
    Route::post('/aturan/store', [AturanController::class, 'store'])
        ->name('aturan.store');
    Route::delete('/aturan/{id}', [AturanController::class, 'destroy'])
        ->name('aturan.destroy');
    Route::put('/aturan/{id}', [AturanController::class,'update'])
        ->name('aturan.update');
    Route::get('/penyakit', [PenyakitController::class,'index'])
    ->name('penyakit');
    Route::post('/penyakit/store', [PenyakitController::class,'store'])
    ->name('penyakit.store');
    Route::put('/penyakit/{id}', [PenyakitController::class,'update'])
        ->name('penyakit.update');
    Route::delete('/penyakit/{id}', [PenyakitController::class,'destroy'])
        ->name('penyakit.destroy');
    Route::get('/riwayat',
    [RiwayatController::class,'index'])
    ->name('riwayat');
    Route::get('/pasien', [PasienController::class,'index'])
    ->name('pasien');
    Route::get('/pakar', [PakarController::class,'index'])
    ->name('pakar');
    Route::post('/pakar/store', [PakarController::class,'store'])
        ->name('pakar.store');
    Route::put('/pakar/{id}', [PakarController::class,'update'])
        ->name('pakar.update');
    Route::delete('/pakar/{id}', [PakarController::class,'destroy'])
        ->name('pakar.destroy');
});