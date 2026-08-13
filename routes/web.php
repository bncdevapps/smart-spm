<?php

use App\Livewire\Admin\DaftarInstansi;
use App\Livewire\Admin\DaftarPengguna;
use App\Livewire\Admin\JenisSpm;
use App\Livewire\Admin\Pajak;
use App\Livewire\Admin\Penyedia;
use App\Livewire\Admin\Potongan;
use App\Livewire\Bendahara\IndexSPM;
use App\Livewire\Bendahara\Laporan;
use App\Livewire\Bendahara\LaporanLembarPenguji;
use App\Livewire\Bendahara\StatusSpm;
use App\Livewire\Bendahara\UbahPassword;
use App\Livewire\Dashboard;
use App\Livewire\Ppk\IndexSpm as PpkIndexSpm;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return redirect('/login');
});
 
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'password-check'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
});

// All authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/preview/dokumen/{dn}/{file}', function ($dn, $file) {
        $path = storage_path('app/private/dokumens/' . $file);

        if (!File::exists($path)) {
            abort(404);
        }

        // Preview PDF langsung di browser
        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $dn . '.pdf"',
        ]);
    })->name('preview.pdf');

    Route::get('/auth/ubah-password', UbahPassword::class)->name('ubah-password');
});

// Bendahara
Route::middleware(['auth', 'user-access:bendahara', 'password-check'])->group(function () {
    Route::get('/bendahara/daftar-spm', IndexSPM::class)->name('daftar-spm');
    Route::get('/bendahara/status-spm', StatusSpm::class)->name('status-spm');
});

// Verifikator dan Admin
Route::middleware(['auth', 'user-access:admin,verifikator'])->group(function () {
    Route::get('/preview/lembar-penguji', LaporanLembarPenguji::class)->name('lembar-penguji');
});

// PPK, Verifikator, Admin, dan Bendahara
Route::middleware(['auth', 'user-access:ppk,verifikator,admin,bendahara', 'password-check'])->group(function () {
    // kode
    // ppk [0 = diajukan]
    // verifikator [1 = verifikasi, 2 = menunggu berkas asli]
    // admin [3 = menunggu berkas asli, 4 = diproses]
    // bendahara [5 = SP2D Terbit]
    Route::get('/review/daftar-spm/{kode}', PpkIndexSpm::class)->name('daftar-spm-review');
});

// Admin dan Bendahara
Route::middleware(['auth', 'user-access:admin,bendahara'])->group(function () {
    Route::get('/laporan-spm/{kode}', Laporan::class)->name('laporan-spm');
    Route::get('/penyedia', Penyedia::class)->name('penyedia');
});

// Admin
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/daftar-instansi', DaftarInstansi::class)->name('daftar-instansi');
    Route::get('/admin/jenis-spm', JenisSpm::class)->name('jenis-spm');
    Route::get('/admin/daftar-pengguna', DaftarPengguna::class)->name('daftar-pengguna');
    Route::get('/admin/pajak', Pajak::class)->name('pajak');
    Route::get('/admin/potongan', Potongan::class)->name('potongan');
});

