<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tambahsiswaipa', [DashboardController::class, 'tambahsiswaipa'])
    ->middleware(['auth', 'verified'])
    ->name('tambahsiswaipa');

Route::get('/tambahsiswaips', [DashboardController::class, 'tambahsiswaips'])
    ->middleware(['auth', 'verified'])
    ->name('tambahsiswaips');

Route::post('/siswa/simpanipa', [DashboardController::class, 'simpansiswaipa'])
    ->name('siswa.simpanipa');

Route::post('/siswa/simpanips', [DashboardController::class, 'simpansiswaips'])
    ->name('siswa.simpanips');

Route::get('/editsiswa/{id_siswa}', [DashboardController::class, 'editsiswa'])
    ->middleware(['auth', 'verified'])
    ->name('siswa.edit');

Route::post('/updatesiswa/{id_siswa}', [DashboardController::class, 'updatesiswaipa'])
    ->middleware(['auth', 'verified'])
    ->name('siswa.update');


Route::get('/ipa', [DashboardController::class, 'tampilipa'])
    ->middleware(['auth', 'verified'])
    ->name('ipa');

Route::get('/ips', [DashboardController::class, 'tampilips'])
    ->middleware(['auth', 'verified'])
    ->name('ips');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
