<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\kasir\kasirController;
use App\Http\Controllers\manager\managerController;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\distributorController;
use App\Http\Controllers\admin\bukuController;
use App\Http\Controllers\admin\pasokController;
use App\Http\Controllers\kasir\transaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('kasir')->name('kasir.')->group(function () {
    Route::middleware(['guest:web','preventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.kasir.login')->name('login');
        Route::post('/check', [kasirController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:web','preventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.kasir.home')->name('home');
        Route::post('/logout', [kasirController::class, 'logout'])->name('logout');
        Route::view('/password', 'dashboard.kasir.password')->name('password');
        Route::patch('/password', [kasirController::class, 'ubahPassword'])->name('password.edit');
        Route::get('/penjualan', [transaksiController::class, 'index'])->name('penjualan');
        Route::post('/penjualan/check', [transaksiController::class, 'check'])->name('penjualan.check');
        Route::get('/penjualan/add/{kode}', [transaksiController::class, 'confirmForm'])->name('pembelian.add');
        Route::post('/penjualan/add/confirm', [transaksiController::class, 'checkOut'])->name('pembelian.add.confirm');
        Route::get('/penjualan/struk', [transaksiController::class, 'struk'])->name('pembelian.struk');
        Route::get('/penjualan/struk/cetak', [transaksiController::class, 'cetakStruk'])->name('pembelian.struk.cetak');
        Route::get('/penjualan/data', [transaksiController::class, 'allData'])->name('pembelian.data');
        Route::get('/penjualan/data/cetak', [transaksiController::class, 'cetakData'])->name('pembelian.data.cetak');
        Route::post('/penjualan/data/filter', [transaksiController::class, 'searchData'])->name('pembelian.data.filter');
        Route::get('/penjualan/data/filter/cetak/{tanggal}', [transaksiController::class, 'cetakDataFilter'])->name('pembelian.data.filter.cetak');
    });
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:admin','preventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.admin.login')->name('login');
        Route::post('/check', [adminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin','preventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.admin.home')->name('home');
        Route::post('/logout', [adminController::class, 'logout'])->name('logout');
        Route::view('/password', 'dashboard.admin.password')->name('password');
        Route::patch('/password', [adminController::class, 'ubahPassword'])->name('password.edit');
        Route::get('/distributor', [distributorController::class, 'index'])->name('distributor');
        Route::post('/distributor', [distributorController::class, 'index'])->name('distributor.search');
        Route::post('/distributor/add', [distributorController::class, 'addDistributor'])->name('distributor.add');
        Route::get('/distributor/{Distributor}/edit', [distributorController::class, 'edit'])->name('distributor.edit');
        Route::patch('/distributor/{Distributor}/update', [distributorController::class, 'update'])->name('distributor.update');
        Route::get('/distributor/{Distributor}/delete', [distributorController::class, 'destroy'])->name('distributor.delete');
        Route::get('/buku', [bukuController::class, 'index'])->name('buku');
        Route::post('/buku', [bukuController::class, 'index'])->name('buku.search');
        Route::post('/buku/add', [bukuController::class, 'add'])->name('buku.add');
        Route::get('/buku/{buku}/edit', [bukuController::class, 'edit'])->name('buku.edit');
        Route::patch('/buku/{buku}/update', [bukuController::class, 'update'])->name('buku.update');
        Route::get('/buku/{buku}/delete', [bukuController::class, 'destroy'])->name('buku.delete');
        Route::get('/buku/data', [bukuController::class, 'allData'])->name('buku.data');
        Route::get('/buku/data/order', [bukuController::class, 'orderData'])->name('buku.data.order');
        Route::post('/buku/data', [bukuController::class, 'searchData'])->name('buku.data.search');
        Route::get('/buku/data/cetak', [bukuController::class, 'cetakData'])->name('buku.data.cetak');
        Route::get('/buku/data/search/cetak/{judul}', [bukuController::class, 'cetakSearchData'])->name('buku.data_search.cetak');
        Route::get('/buku/data/order/cetak', [bukuController::class, 'cetakDataOrder'])->name('buku.data.order.cetak');
        Route::get('/buku/filter', [bukuController::class, 'bookFilter'])->name('buku.filter');
        Route::get('/buku/filter/{buku}', [bukuController::class, 'bookFilterReady'])->name('buku.filter.result');
        Route::get('/buku/filter/cetak/{buku}', [bukuController::class, 'bookFilterCetak'])->name('buku.filter.cetak');
        Route::get('/buku/takterjual', [bukuController::class, 'bukuTakterjual'])->name('buku.takterjual');
        Route::post('/buku/takterjual/search', [bukuController::class, 'searchBukuTakterjual'])->name('buku.takterjual.search');
        Route::get('/buku/takterjual/cetak', [bukuController::class, 'bukuTakterjualCetak'])->name('buku.takterjual.cetak');
        Route::get('/buku/terjual', [bukuController::class, 'bukuTerjual'])->name('buku.terjual');
        Route::post('/buku/terjual/search', [bukuController::class, 'bukuTerjualSearch'])->name('buku.terjual.search');
        Route::get('/buku/terjual/cetak', [bukuController::class, 'bukuTerjualCetak'])->name('buku.terjual.cetak');
        Route::get('/pasok', [pasokController::class, 'index'])->name('pasok');
        Route::post('/pasok', [pasokController::class, 'searchPasok'])->name('pasok.search');
        Route::post('/pasok/add', [pasokController::class, 'add'])->name('pasok.add');
        Route::get('/pasok/{pasok}/edit', [pasokController::class, 'edit'])->name('pasok.edit');
        Route::patch('/pasok/{pasok}/update', [pasokController::class, 'update'])->name('pasok.update');
        Route::get('/pasok/{pasok}/delete', [pasokController::class, 'destroy'])->name('pasok.delete');
        Route::get('/pasok/data', [pasokController::class, 'allData'])->name('pasok.data');
        Route::post('/pasok/data/search', [pasokController::class, 'searchData'])->name('pasok.data.search');
        Route::post('/pasok/data/search/cetak', [pasokController::class, 'searchDataCetak'])->name('pasok.search.cetak');
        Route::get('/pasok/data/cetak', [pasokController::class, 'cetakAll'])->name('pasok.cetak');
        Route::get('/pasok/filter', [pasokController::class, 'pasokFilter'])->name('pasok.filter');
        Route::get('/pasok/filter/{pasok}', [pasokController::class, 'pasokFilterReady'])->name('pasok.filter.result');
        Route::get('/pasok/filter/cetak/{pasok}', [pasokController::class, 'pasokFilterCetak'])->name('pasok.filter.cetak');
    });
});

Route::prefix('manager')->name('manager.')->group(function () {
    Route::middleware(['guest:manager', 'preventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.manager.login')->name('login');
        Route::post('/check', [managerController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:manager', 'preventBackHistory'])->group(function () {
        Route::view('/home', 'dashboard.manager.home')->name('home');
        Route::post('/logout', [managerController::class, 'logout'])->name('logout');
        Route::view('/password', 'dashboard.manager.password')->name('password');
        Route::patch('/password', [managerController::class, 'ubahPassword'])->name('password.edit');
        Route::view('/register', 'dashboard.manager.register')->name('register');
        Route::post('/create', [managerController::class, 'create'])->name('create');
        Route::get('/faktur', [managerController::class, 'getFaktur'])->name('faktur');
        Route::get('/faktur/cetak', [managerController::class, 'cetakFaktur'])->name('faktur.cetak');
        Route::get('/penjualan', [managerController::class, 'dataPenjualan'])->name('penjualan');
        Route::get('/penjualan/cetak', [managerController::class, 'cetakPenjualan'])->name('penjualan.cetak');
        Route::post('/penjualan/filter', [managerController::class, 'searchPenjualan'])->name('penjualan.filter');
        Route::get('/penjualan/filter/{tanggal}', [managerController::class, 'cetakPenjualanFilter'])->name('penjualan.cetak.filter');
        Route::get('/buku', [managerController::class, 'dataBuku'])->name('buku');
        Route::post('/buku/search', [managerController::class, 'searchBuku'])->name('buku.search');
        Route::get('/buku/search/{judul}', [managercontroller::class, 'cetakBukuSearch'])->name('buku.search.cetak');
        Route::get('/buku/cetak', [managerController::class, 'cetakBuku'])->name('buku.cetak');
        Route::get('/buku/order', [managerController::class, 'orderDataBuku'])->name('buku.order');
        Route::get('/buku/order/cetak', [managerController::class, 'cetakBukuOrder'])->name('buku.order.cetak');
        Route::get('/buku/filter/penulis', [managerController::class, 'filterPenulis'])->name('filter.penulis');
        Route::get('/buku/filter/{penulis}/result', [managerController::class, 'filterPenulisResult'])->name('filter.penulis.result');
        Route::get('/buku/filter/{penulis}/cetak', [managerController::class, 'filterPenulisCetak'])->name('filter.penulis.cetak');
        Route::get('/buku/takterjual', [managerController::class, 'bukuTakterjual'])->name('buku.takterjual');
        Route::post('/buku/takterjual/search', [managerController::class, 'bukuTakterjualSearch'])->name('buku.takterjual.search');
        Route::get('/buku/takterjual/cetak', [managerController::class, 'bukuTakterjualCetak'])->name('buku.takterjual.cetak');
        Route::get('/buku/terjual', [managerController::class, 'bukuTerjual'])->name('buku.terjual');
        Route::post('/buku/terjual/search', [managerController::class, 'bukuTerjualSearch'])->name('buku.terjual.search');
        Route::get('/buku/terjual/cetak', [managerController::class, 'bukuTerjualCetak'])->name('buku.terjual.cetak');
        Route::get('/pasok', [managerController::class, 'dataPasok'])->name('pasok');
        Route::post('/pasok/search', [managerController::class, 'searchPasok'])->name('pasok.search');
        Route::post('/pasok/search/cetak', [managerController::class, 'cetakPasokSearch'])->name('pasok.search.cetak');
        Route::get('/pasok/cetak', [managerController::class, 'cetakPasok'])->name('pasok.cetak');
        Route::get('/pasok/filter', [managerController::class, 'pasokFilter'])->name('filter.pasok');
        Route::get('/pasok/filter/{nama}', [managerController::class, 'pasokFilterResult'])->name('filter.pasok.result');
        Route::get('/pasok/filter/cetak/{nama}', [managerController::class, 'cetakFilterPasok'])->name('filter.pasok.cetak');
        Route::get('/user', [managerController::class, 'getUser'])->name('user');
        Route::get('/user/cetak', [managerController::class, 'cetakUser'])->name('user.cetak');
        Route::post('/user/search', [managerController::class, 'searchUser'])->name('user.search');
        Route::get('/user/search/cetak/{nama}', [managerController::class, 'searchUserCetak'])->name('user.search.cetak');
        Route::get('/user/edit', [managerController::class, 'editUser'])->name('user.edit');
        Route::post('/user/edit/select', [managerController::class, 'editUserSelected'])->name('user.edit.select');
        Route::get('/user/edit/select/{id}', [managerController::class, 'updateUser'])->name('user.update');
        Route::post('/user/update', [managerController::class, 'updated'])->name('user.data.update');
        Route::get('/user/delete/{id}', [managerController::class, 'deleteUser'])->name('user.delete');
    });
});