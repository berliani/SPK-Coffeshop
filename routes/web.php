<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\ObjekController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\TopsisController;
use App\Http\Controllers\Auth\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekomendasiController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing.index');
});

Route::middleware(['auth', 'verified', 'check.role'])->group(function () {
    Route::get('/dashboard', function () {
        // Dashboard logic
    })->name('dashboard');

    Route::middleware('check.role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            // Admin dashboard logic
        })->name('admin.dashboard.index');
    });

    Route::middleware('check.role:pengguna')->group(function () {
        Route::get('/user/dashboard', function () {
            // User dashboard logic, untuk sekarang ke admin dulu
        })->name('admin.dashboard.index');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/google', [SocialiteController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback'])->name('auth.google.callback');

// Additional user routes
Route::get('/landing-topsis', function () {
    return view('user.hitung.landing-topsis');
})->name('landing-topsis');

Route::get('/kriteria1', function () {
    return view('user.hitung.kriteria-1');
})->name('kriteria1');

Route::get('/kriteria-2', [RekomendasiController::class, 'goToKriteria2'])->name('kriteria2');
Route::post('/rekomendasi', [TopsisController::class, 'rekomendasi'])->name('rekomendasi');

// Route::get('/lokasi', function () {
//     return view('user.hitung.kriteria-3');
// })->name('kriteria3');

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'kriteria'], function () {
        Route::get('/', [KriteriaController::class, 'index'])->name('kriteria');
        Route::post('/simpan', [KriteriaController::class, 'simpan'])->name('kriteria.simpan');
        Route::get('/ubah', [KriteriaController::class, 'ubah'])->name('kriteria.ubah');
        Route::post('/ubah', [KriteriaController::class, 'perbarui'])->name('kriteria.perbarui');
        Route::post('/hapus', [KriteriaController::class, 'hapus'])->name('kriteria.hapus');
    });

    Route::group(['prefix' => 'sub_kriteria'], function () {
        Route::get('/', [SubKriteriaController::class, 'index'])->name('sub_kriteria');
        Route::post('/simpan', [SubKriteriaController::class, 'simpan'])->name('sub_kriteria.simpan');
        Route::get('/ubah', [SubKriteriaController::class, 'ubah'])->name('sub_kriteria.ubah');
        Route::post('/ubah', [SubKriteriaController::class, 'perbarui'])->name('sub_kriteria.perbarui');
        Route::post('/hapus', [SubKriteriaController::class, 'hapus'])->name('sub_kriteria.hapus');
    });

    Route::group(['prefix' => 'objek'], function () {
        Route::get('/', [ObjekController::class, 'index'])->name('objek');
        Route::post('/simpan', [ObjekController::class, 'simpan'])->name('objek.simpan');
        Route::get('/ubah', [ObjekController::class, 'ubah'])->name('objek.ubah');
        Route::post('/ubah', [ObjekController::class, 'perbarui'])->name('objek.perbarui');
        Route::post('/hapus', [ObjekController::class, 'hapus'])->name('objek.hapus');
        Route::post('/import', [ObjekController::class, 'import'])->name('objek.import');
    });

    Route::group(['prefix' => 'alternatif'], function () {
        Route::get('/', [AlternatifController::class, 'index'])->name('alternatif');
        Route::post('/simpan', [AlternatifController::class, 'simpan'])->name('alternatif.simpan');
        Route::post('/hapus', [AlternatifController::class, 'hapus'])->name('alternatif.hapus');
    });

    Route::group(['prefix' => 'penilaian'], function () {
        Route::get('/', [PenilaianController::class, 'index'])->name('penilaian');
        Route::post('/simpan', [PenilaianController::class, 'simpan'])->name('penilaian.simpan');
        Route::get('/ubah/{alternatif_id}', [PenilaianController::class, 'ubah'])->name('penilaian.ubah');
        Route::post('/ubah/{alternatif_id}', [PenilaianController::class, 'perbarui'])->name('penilaian.perbarui');
        Route::post('/hapus', [PenilaianController::class, 'hapus'])->name('penilaian.hapus');
    });

    Route::get('/perhitungan', [TopsisController::class, 'index'])->name('perhitungan');
    Route::post('/hitung_topsis', [TopsisController::class, 'hitungTopsis'])->name('hitung_topsis');
    Route::get('/hasil_akhir', [TopsisController::class, 'hasilAkhir'])->name('hasil_akhir');
});

require __DIR__.'/auth.php';
