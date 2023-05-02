<?php

use App\Http\Controllers\AkunController;
use App\Http\Controllers\BomController;
use App\Http\Controllers\MoController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RfqController;
use App\Http\Controllers\SQController;
use App\Http\Controllers\VendorController;
use Illuminate\Queue\Jobs\SqsJob;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Gd\Commands\RotateCommand;

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
Route::get('/produk',[ProdukController::class,'kabehProduk'])->name('Produk');
Route::get('/produkinput', [ProdukController::class,'produkInput'])->name('ProdukInput');
Route::post('/produkupload',[ProdukController::class,'produkUpload'])->name('UploadProduk');
Route::get('/produkedit/{id_produk}', [ProdukController::class,'produkEditView'])->name('ProdukEdit');
Route::put('/produkedit/edit/{id_produk}', [ProdukController::class,'produkUpdate'])->name('ProdukUpdate');
Route::delete('/produkdelete/{id_produk}',[ProdukController::class,'Produkdelete'])->name('DeleteProduk');
//BOM
Route::get('/bom', [BomController::class,'tampilBom'])->name('tampilBom');
Route::get('/bom-input', [BomController::class,'materialInput'])->name('MasukBOM');
Route::post('/bom/bomMasuk',[BomController::class,'uploadBOM']);
Route::get('/bom/delete/{kode_bom}',[BomController::class,'deletbom']);
Route::get('/bom/item_list/{kode_bom}',[BomController::class,'materialInputItems']);
Route::post('/bom/item_list/upload',[BomController::class,'uploadList']);
Route::get('/bom/delete_item_list/{kode_bom_list}',[BomController::class,'deleteList']);
//MO
Route::get('/mo',[MoController::class,'manufactureOrder'])->name('tampilMO');
Route::post('/mo/upload',[MoController::class,'moUpload'])->name('moUpload');
Route::put('/mo/update/{kode_mo}',[MoController::class,'moUpdate']);
Route::put('/mo/update/produk/{kode_mo}',[MoController::class,'moUpdateProduk']);
Route::get('/mo/update/produk/cek/{kode_mo}',[MoController::class,'caItems']);
Route::post('/mo/produksi/{kode_mo}',[MoController::class,'moProduce']);
Route::post('/mo/produksi/proses/{kode_mo}',[MoController::class,'moProsesProduce']);
//vendor
Route::get('/vendor_user',[VendorController::class,'VendorTampil'])->name('Vendor');
Route::get('/vendor_user/input',[VendorController::class,'inputVendorTampil'])->name('inputVendor');
Route::post('/vendor_user/input/proses',[VendorController::class,'inputVendor'])->name('ProsesInputVendor');
Route::get('/vendor_user/edit/tampil/{id_vendor}',[VendorController::class,'editVendorTampil']);
Route::put('/vendor_user/edit/upload/{id_vendor}',[VendorController::class,'editVendor']);
Route::delete('/vendor/delete/{id_vendor}',[VendorController::class,'deleteVendor']);
//rfq
Route::get('/rfq/data',[RfqController::class,'rfqTampil'])->name('RfqTampil');
Route::get('/rfq/data/input',[RfqController::class,'inputRfqTampil'])->name('InputRfq');
Route::post('/rfq/data/input/proses',[RfqController::class,'InputRFQ']);
Route::get('/rfq/data/list/{id_rfq}',[RfqController::class,'rfqList'])->name('RfqList');
Route::post('/rfq/data/list/proses',[RfqController::class,'ListProses'])->name('ListProses');
Route::post('/rfq/data/list/saveitem/{id_rfq}',[RfqController::class,'rfqSimpanBarang'])->name('RfqListSimpan');
Route::post('/rfq/data/list/Pembayaran/{id_rfq}',[RfqController::class,'rfqPembayaran'])->name('RfqListPembayaran');
Route::post('/rfq/data/list/Pembayaran/confirm/{id_rfq}',[RfqController::class,'rfqConfirmPembayaran'])->name('RfqListPembayaranComfirm');
Route::delete('/rfq/delete/{id_rfq}',[RfqController::class,'rfqDelete']);
//SQ
Route::get('/SQ/data',[SQController::class,'tampilSQ'])->name('sqTampil');
Route::get('/SQ/data/input',[SQController::class,'tampilSQmasuk'])->name('sqTampilMasuk');
Route::post('/SQ/data/input/proses',[SQController::class,'SQProses'])->name('SQProses');
Route::get('/SQ/data/input/list/{id_sq}',[SQController::class,'SQList']);
Route::post('/SQ/data/input/produk/',[SQController::class,'sqUploadItems'])->name('UploadProdukSQ');
Route::get('/SQ/data/list/save/{id_sq}',[SQController::class,'saveItems']);
Route::get('/SQ/data/list/cek/{id_sq}',[SQController::class,'caItems']);
Route::post('/SQ/data/list/ca/{id_sq}',[SQController::class,'salesCreateBill']);
Route::post('/SQ/data/list/bp/{id_sq}',[SQController::class,'confirmBill']);
Route::delete('/SQ/data/hapus/{id_sq}',[SQController::class,'hapusSQ']);
//akuntan
Route::get('/Akun',[AkunController::class,'AkunTampil'])->name('tampilAkun');
ROute::get('/Akun/SQ',[AkunController::class,'invoice'])->name('invoice');
ROute::post('/Akun/SQ/tanggal/',[AkunController::class,'invoicePertanggal']);
ROute::get('/Akun/RFQ',[AkunController::class,'bill'])->name('bill');
ROute::post('/Akun/RFQ/tanggal',[AkunController::class,'billPertanggal']);








?>



