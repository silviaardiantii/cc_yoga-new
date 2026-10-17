<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\YogaClassController;
use App\Http\Controllers\BookingController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Alur: pilih paket -> bayar -> dapat kode pelanggan -> booking kelas
Route::get('/paket', [PurchaseController::class, 'index'])->name('purchases.index');
Route::post('/paket/beli', [PurchaseController::class, 'store'])->name('purchases.store');
Route::get('/paket/berhasil/{reference}', [PurchaseController::class, 'success'])->name('purchases.success');

Route::get('/jadwal', [YogaClassController::class, 'index'])->name('classes.index');

Route::get('/booking/{classId}', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/booking', [BookingController::class, 'store'])->name('bookings.store');

Route::get('/riwayat', [BookingController::class, 'history'])->name('history.index');
Route::post('/booking/{bookingId}/reschedule', [BookingController::class, 'reschedule'])->name('bookings.reschedule');
