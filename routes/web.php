<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'tampilDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/tambahmahasiswa', [DashboardController::class, 'tambahMahasiswa'])
    ->name('tambahmahasiswa');

Route::get('/editalternatif/{id}', [DashboardController::class, 'editAlternatif'])
    ->name('editalternatif');

Route::put('/updatealternatif/{id}', [DashboardController::class, 'updateAlternatif'])
    ->name('updatealternatif');

Route::post('/simpanmahasiswa', [DashboardController::class, 'simpanMahasiswa'])
    ->name('simpanmahasiswa');

Route::get('/editmahasiswa/{id}', [DashboardController::class, 'editMahasiswa'])
    ->name('editmahasiswa');

Route::put('/updatemahasiswa/{id}', [DashboardController::class, 'updateMahasiswa'])
    ->name('updatemahasiswa');

Route::delete('hapusmahasiswa/{id}', [DashboardController::class, 'hapusMahasiswa'])
    ->name('hapusmahasiswa');

Route::get('/jurusans1tk', [DashboardController::class, 'tampilJurusanS1TK'])
    ->name('jurusans1tk');

Route::get('/jurusans1si', [DashboardController::class, 'tampilJurusanS1SI'])
    ->name('jurusans1si');

Route::get('/jurusand3si', [DashboardController::class, 'tampilJurusanD3SI'])
    ->name('jurusand3si');

Route::get('/kriteria', [DashboardController::class, 'tampilKriteria'])
    ->name('kriteria');

Route::get('/editkriteria/{id}', [DashboardController::class, 'editKriteria'])
    ->name('editkriteria');

Route::put('/updatekriteria/{id}', [DashboardController::class, 'updateKriteria'])
    ->name('updatekriteria');

Route::get('/tambahkriteria', [DashboardController::class, 'tambahKriteria'])
    ->name('tambahkriteria');

Route::post('/simpankriteria', [DashboardController::class, 'simpanKriteria'])
    ->name('simpankriteria');

Route::delete('/hapuskriteria/{id}', [DashboardController::class, 'hapusKriteria'])
    ->name('hapuskriteria');

Route::get('/perhitungan', [DashboardController::class, 'tampilPerhitungan'])
    ->name('perhitungan');

Route::get('/detailperhitungan/{id}', [DashboardController::class, 'detailPerhitungan'])
    ->name('detailperhitungan');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
