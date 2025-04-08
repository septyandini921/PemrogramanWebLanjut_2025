<?php

use App\Http\Controllers\LevelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;

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
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);

Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

//W5 Prak 2
Route::get('/', [WelcomeController::class,'index']);
//W6
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']); // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']); // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']); // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']); // menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']);      // Menyimpan data user baru Ajax
    Route::get('/{id}', [UserController::class, 'show']); // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']); // menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']); // Menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Untuk tampilkan form confirm delete user Ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

//implementasi m_level
Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index'])->name('level.index'); // Menampilkan daftar level
    Route::post('/list', [LevelController::class, 'getLevels'])->name('level.list'); // DataTables JSON
    Route::get('/create', [LevelController::class, 'create'])->name('level.create'); // Form tambah
    Route::post('/', [LevelController::class, 'store'])->name('level.store'); // Simpan data baru
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah level Ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menyimpan data level baru Ajax
    Route::get('/{id}', [LevelController::class, 'show'])->name('level.show'); // Menampilkan detail level
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax'])->name('level.edit_ajax'); // Form edit (AJAX)
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax'])->name('level.update_ajax'); // Simpan perubahan (AJAX)
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax'])->name('level.confirm_ajax'); 
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax'])->name('level.delete_ajax');
    Route::get('/{id}/edit', [LevelController::class, 'edit'])->name('level.edit'); // Form edit
    Route::put('/{id}', [LevelController::class, 'update'])->name('level.update'); // Simpan perubahan
    Route::delete('/{id}', [LevelController::class, 'destroy'])->name('level.destroy'); // Hapus level
});

//implementasi m_kategori
Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index'])->name('kategori.index'); // Menampilkan daftar kategori
    Route::post('/list', [KategoriController::class, 'getKategori'])->name('kategori.list'); // Data JSON untuk DataTables
    Route::get('/create', [KategoriController::class, 'create'])->name('kategori.create'); // Form tambah kategori
    Route::post('/', [KategoriController::class, 'store'])->name('kategori.store'); // Simpan kategori baru
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax'])->name('kategori.create_ajax');// Form tambah kategori (AJAX)
    Route::post('/ajax', [KategoriController::class, 'store_ajax'])->name('kategori.store_ajax'); // Simpan kategori baru (AJAX)
    Route::get('/{id}', [KategoriController::class, 'show'])->name('kategori.show'); // Detail kategori
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax'])->name('kategori.edit_ajax'); // Form edit kategori (AJAX)
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax'])->name('kategori.update_ajax'); // Simpan perubahan kategori (AJAX)
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax'])->name('kategori.confirm_ajax'); // Konfirmasi hapus (AJAX)
    Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit'); // Form edit kategori
    Route::put('/{id}', [KategoriController::class, 'update'])->name('kategori.update'); // Simpan perubahan kategori
    Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy'); // Hapus kategori
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax'])->name('kategori.delete_ajax'); // Hapus kategori (AJAX)
});


//implementasi m_supplier
Route::group(['prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index'])->name('supplier.index'); // Menampilkan daftar supplier
    Route::post('/list', [SupplierController::class, 'getSuppliers'])->name('supplier.list'); // Data JSON untuk DataTables
    Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create'); // Form tambah supplier
    Route::post('/', [SupplierController::class, 'store'])->name('supplier.store'); // Simpan supplier baru
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax'])->name('supplier.create_ajax'); // Form tambah supplier (AJAX)
    Route::post('/ajax', [SupplierController::class, 'store_ajax'])->name('supplier.store_ajax'); // Simpan supplier baru (AJAX)
    Route::get('/{id}', [SupplierController::class, 'show'])->name('supplier.show'); // Detail supplier
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax'])->name('supplier.edit_ajax'); // Form edit supplier (AJAX)
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax'])->name('supplier.update_ajax'); // Simpan perubahan supplier (AJAX)
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax'])->name('supplier.confirm_ajax'); // Konfirmasi hapus (AJAX)
    Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit'); // Form edit supplier
    Route::put('/{id}', [SupplierController::class, 'update'])->name('supplier.update'); // Simpan perubahan supplier
    Route::delete('/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy'); // Hapus supplier
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax'])->name('supplier.delete_ajax'); // Hapus supplier (AJAX)
});

//implementasi m_barang
// Route::group(['prefix' => 'barang'], function () {
//     Route::get('/', [BarangController::class, 'index'])->name('barang.index');
//     Route::post('/list', [BarangController::class, 'getBarang'])->name('barang.list');
//     Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
//     Route::post('/', [BarangController::class, 'store'])->name('barang.store');
//     Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
//     Route::post('/ajax', [BarangController::class, 'store_ajax']);
//     Route::get('/{id}', [BarangController::class, 'show'])->name('barang.show');
//     Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
//     Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
//     Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
//     Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
//     Route::put('/{id}', [BarangController::class, 'update'])->name('barang.update');
//     Route::delete('/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
//     Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
// });

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/list', [BarangController::class, 'getBarang'])->name('barang.list');
    Route::get('/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('/', [BarangController::class, 'store'])->name('barang.store');
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
    Route::post('/ajax', [BarangController::class, 'store_ajax']);
    Route::get('/{id}', [BarangController::class, 'show'])->name('barang.show');
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
    Route::get('/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);

    Route::get('/{id}/confirm_delete', [BarangController::class, 'confirm_ajax'])->name('barang.confirm_delete');
});