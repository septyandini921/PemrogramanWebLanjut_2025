<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiController;
 

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

Route::pattern('id', '[0-9]+'); //artinya ketika parameter {id}, maka harus berupa angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');

//form register
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store_user'])->name('store_user');

Route::middleware(['auth'])->group(function () { // artinya semua route di dalam group ini harus login dulu
Route::get('/', [WelcomeController::class,'index']);

Route::get('/dashboard', function () {
    return view('dashboard'); // atau view lain yang kamu gunakan
})->name('dashboard');


Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


Route::middleware(['authorize:ADM,MNG,STF'])->prefix('user')->group(function (){
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
    // Route::get('/import', [UserController::class, 'import']);
    // Route::post('/import_ajax', [UserController::class, 'import_ajax'])->name('user.import_ajax');
    Route::get('/import', [UserController::class, 'import']);
    Route::post('/import_ajax', [UserController::class, 'import_ajax']);

    Route::get('/export_excel', [UserController::class, 'export_excel']);
    Route::get('/export_pdf', [UserController::class, 'export_pdf']);
});

Route::middleware(['authorize:ADM,MNG,STF'])->prefix('level')->group(function () {
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
    Route::get('/import', [LevelController::class, 'import']);
    Route::post('/import_ajax', [LevelController::class, 'import_ajax']);
    Route::get('/export_excel', [LevelController::class, 'export_excel']);
    Route::get('/export_pdf', [LevelController::class, 'export_pdf']);
});

Route::middleware(['authorize:ADM,MNG,STF'])->prefix('kategori')->group(function () {
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
    Route::get('/import', [KategoriController::class, 'import']);
    Route::post('/import_ajax', [KategoriController::class, 'import_ajax']);
    Route::get('/export_excel', [KategoriController::class, 'export_excel']);
    Route::get('/export_pdf', [KategoriController::class, 'export_pdf']);
});

Route::middleware(['authorize:ADM,MNG,STF'])->prefix('supplier')->group(function () {
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
    Route::get('/import', [SupplierController::class, 'import']);
    Route::post('/import_ajax', [SupplierController::class, 'import_ajax']);
    Route::get('/export_excel', [SupplierController::class, 'export_excel']);
    Route::get('/export_pdf', [SupplierController::class, 'export_pdf']);
});


Route::middleware(['authorize:ADM,MNG,STF'])->prefix('barang')->group(function () {
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
    Route::get('/import', [BarangController::class, 'import']);
    Route::post('/import_ajax', [BarangController::class, 'import_ajax']);
    Route::get('/export_pdf', [BarangController::class, 'export_pdf']);// export excel
});

Route::middleware(['authorize:ADM,MNG,STF'])->prefix('stok')->group(function () {
    Route::get('/', [StokController::class, 'index'])->name('stok.index');
    Route::post('/list', [StokController::class, 'getStok'])->name('stok.list');
    Route::get('/create', [StokController::class, 'create'])->name('stok.create');
    Route::post('/', [StokController::class, 'store'])->name('stok.store');
    Route::get('/create_ajax', [StokController::class, 'create_ajax']);
    Route::post('/ajax', [StokController::class, 'store_ajax']);
    Route::get('/{id}', [StokController::class, 'show'])->name('stok.show');
    Route::get('/{id}/show_ajax', [StokController::class, 'show_ajax']);
    Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']);
    Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']);
    Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);
    Route::get('/{id}/edit', [StokController::class, 'edit'])->name('stok.edit');
    Route::put('/{id}', [StokController::class, 'update'])->name('stok.update');
    Route::delete('/{id}', [StokController::class, 'destroy'])->name('stok.destroy');
    Route::get('/import', [StokController::class, 'import']);
    Route::post('/import_ajax', [StokController::class, 'import_ajax']);
    Route::get('/export_excel', [StokController::class, 'export_excel']);
    Route::get('/export_pdf', [StokController::class, 'export_pdf']);
});

// Tambahkan ini di dalam group middleware auth (setelah route transaksi)

Route::middleware(['authorize:ADM,MNG,STF'])->prefix('transaksi')->group(function () {
    Route::get('/', [TransaksiController::class, 'index']); // Menampilkan halaman awal transaksi
    Route::post('/list', [TransaksiController::class, 'getPenjualan'])->name('transaksi.list'); // Menampilkan data transaksi dalam bentuk JSON untuk DataTables
    Route::get('/create_ajax', [TransaksiController::class, 'create_ajax']); // Menampilkan halaman form tambah transaksi (Ajax)
    Route::post('/ajax', [TransaksiController::class, 'store_ajax']); // Menyimpan data transaksi baru (Ajax)
    Route::get('/{id}/show_ajax', [TransaksiController::class, 'show_ajax']); // Menampilkan detail transaksi (Ajax)
    Route::get('/{id}/edit_ajax', [TransaksiController::class, 'edit_ajax']); // Menampilkan form edit transaksi (Ajax)
    Route::put('/{id}/update_ajax', [TransaksiController::class, 'update_ajax']); // Menyimpan perubahan data transaksi (Ajax)
    Route::get('/{id}/delete_ajax', [TransaksiController::class, 'confirm_ajax']); // Tampilkan konfirmasi hapus transaksi (Ajax)
    Route::delete('/{id}/delete_ajax', [TransaksiController::class, 'delete_ajax']); // Hapus data transaksi (Ajax)
    Route::get('/import', [TransaksiController::class, 'import']); // Form impor transaksi
    Route::post('/import_ajax', [TransaksiController::class, 'import_ajax']); // Proses impor transaksi
    Route::get('/export_excel', [TransaksiController::class, 'export_excel']); // Ekspor transaksi ke Excel
    Route::get('/export_pdf', [TransaksiController::class, 'export_pdf']); // Ekspor transaksi ke PDF
});

});