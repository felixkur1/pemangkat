<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthorArtikelController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DokumenPublikController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LokasiPentingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BerandaController::class, 'index_guest'])->name('beranda.index.guest');

Route::get('/visi-misi', [VisiMisiController::class, 'index_guest'])->name('visi-misi.index.guest');

Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index_guest'])->name('struktur-organisasi.index.guest');

Route::get('/dokumen-publik', [DokumenPublikController::class, 'index_guest'])->name('dokumen-publik.index.guest');
Route::get('/dokumen-publik/{publicDocument}', [DokumenPublikController::class, 'download'])->name('dokumen-publik.download');

Route::view('/lokasi-penting', 'guest.lokasi-penting.index')->name('lokasi-penting.index.guest');

Route::get('/artikel', [ArtikelController::class, 'index_guest'])->name('artikel.index.guest');
Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('artikel.show.guest');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

Route::middleware("guest")->group(function () {
  Route::get('/login', [LoginController::class, 'index'])->name('login');
  Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware("auth");

Route::prefix('/admin')->middleware(['auth', 'admin'])->group(function () {
  
  Route::get('/beranda', [BerandaController::class, 'index_admin'])->name('beranda.index.admin');
  Route::put('/beranda', [BerandaController::class, 'update'])->name('admin.beranda.update');

  Route::get('/visi-misi', [VisiMisiController::class, 'index_admin'])->name('visi-misi.index.admin');
  Route::post('/visi-misi', [VisiMisiController::class, 'store'])->name('visi-misi.store.admin');
  Route::put('/visi-misi/vision', [VisiMisiController::class, 'update_visi'])->name('visi-misi.update.visi.admin');
  Route::put('/visi-misi/mission', [VisiMisiController::class, 'update_misi'])->name('visi-misi.update.misi.admin');
  Route::delete('/visi-misi/{mission}', [VisiMisiController::class, 'destroy'])->name('visi-misi.destroy.admin');

  Route::get('/pegawai', [PegawaiController::class, 'index_admin'])->name('pegawai.index.admin');
  Route::post('/pegawai', [PegawaiController::class, 'store'])->name('pegawai.store.admin');
  Route::put('/pegawai/{employee}', [PegawaiController::class, 'update'])->name('pegawai.update.admin');
  Route::delete('/pegawai/{employee}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy.admin');

  Route::get('/struktur-organisasi', [StrukturOrganisasiController::class, 'index_admin'])->name('struktur-organisasi.index.admin');
  Route::post('/struktur-organisasi/group', [StrukturOrganisasiController::class, 'store_group'])->name('struktur-organisasi.group.store.admin');
  Route::put('/struktur-organisasi/group/{orgGroup}', [StrukturOrganisasiController::class, 'update_group'])->name('struktur-organisasi.group.update.admin');
  Route::delete('/struktur-organisasi/group/{orgGroup}', [StrukturOrganisasiController::class, 'destroy_group'])->name('struktur-organisasi.group.destroy.admin');

  Route::post('/struktur-organisasi', [StrukturOrganisasiController::class, 'store'])->name('struktur-organisasi.store.admin');
  Route::put('/struktur-organisasi/{orgStructure}', [StrukturOrganisasiController::class, 'update'])->name('struktur-organisasi.update.admin');
  Route::delete('/struktur-organisasi/{orgStructure}', [StrukturOrganisasiController::class, 'destroy'])->name('struktur-organisasi.destroy.admin');

  Route::get('/dokumen-publik', [DokumenPublikController::class, 'index_admin'])->name('dokumen-publik.index.admin');
  Route::post('/dokumen-publik', [DokumenPublikController::class, 'store'])->name('dokumen-publik.store.admin');
  Route::put('/dokumen-publik/{publicDocument}', [DokumenPublikController::class, 'update'])->name('dokumen-publik.update.admin');
  Route::delete('/dokumen-publik/{publicDocument}', [DokumenPublikController::class, 'destroy'])->name('dokumen-publik.destroy.admin');

  Route::get('/lokasi-penting', [LokasiPentingController::class, 'index_admin'])->name('lokasi-penting.index.admin');
  Route::post('/lokasi-penting', [LokasiPentingController::class, 'store'])->name('lokasi-penting.store.admin');
  Route::put('/lokasi-penting/{lokasi}', [LokasiPentingController::class, 'update'])->name('lokasi-penting.update.admin');
  Route::delete('/lokasi-penting/{lokasi}', [LokasiPentingController::class, 'destroy'])->name('lokasi-penting.destroy.admin');
  
  Route::get('/artikel', [ArtikelController::class, 'index_admin'])->name('artikel.index.admin');
  Route::post('/artikel', [ArtikelController::class, 'store'])->name('artikel.store.admin');
  Route::get('/artikel/{article}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit.admin');
  Route::put('/artikel/{article}', [ArtikelController::class, 'update'])->name('artikel.update.admin');
  Route::put('/artikel/{article}/toggle-publish', [ArtikelController::class, 'togglePublish'])->name('artikel.toggle-publish.admin');
  Route::put('/artikel/{article}/toggle-highlight', [ArtikelController::class, 'toggleHighlight'])->name('artikel.toggle-highlight.admin');
  Route::delete('/artikel/{article}', [ArtikelController::class, 'destroy'])->name('artikel.destroy.admin');
  Route::get('/artikel/search', [ArtikelController::class, 'search'])->name('artikel.search');
  
  Route::get('/author-setting', [UserController::class, 'index'])->name('author-setting.index.admin');
  Route::post('/author-setting', [UserController::class, 'store_author'])->name('author-setting.store.admin');
  Route::put('/author-setting/{user}', [UserController::class, 'update_author'])->name('author-setting.update.admin');
  Route::delete('/author-setting/{user}', [UserController::class, 'destroy_author'])->name('author-setting.destroy.admin');

});

Route::prefix('/author')->middleware(['auth','author'])->group(function () {
  Route::get('/', [AuthorArtikelController::class, 'index'])->name('artikel.index.author');
  Route::post('/artikel', [ArtikelController::class, 'store'])->name('artikel.store.author');
  Route::get('/artikel/{article}/edit', [ArtikelController::class, 'edit_author'])->name('artikel.edit.author');
  Route::put('/artikel/{article}', [ArtikelController::class, 'update'])->name('artikel.update.author');
  Route::put('/artikel/{article}/toggle-publish', [ArtikelController::class, 'togglePublish'])->name('artikel.toggle-publish.author');
  Route::delete('/artikel/{article}', [ArtikelController::class, 'destroy'])->name('artikel.destroy.author');
});