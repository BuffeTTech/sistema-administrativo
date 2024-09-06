<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BuffetController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::patch('/subscription/permissions/{permission}', [SubscriptionController::class, 'add_role'])->name('buffet.permissions.add_role');

Route::put('/buffet/{slug}', [BuffetController::class, 'update_buffet_api'])->name('api.buffet.update');

Route::post('/{buffet}/booking', [BookingController::class, 'store_booking_api'])->name('api.booking.store');
Route::put('/{buffet}/booking', [BookingController::class, 'update_booking_api'])->name('api.booking.update');
Route::put('/{buffet}/booking/status', [BookingController::class, 'change_booking_status_api'])->name('api.booking.change_status');

// Route::group(function() {
//     Route::get('/permissions/{permission}', [SubscriptionController::class, 'get_roles_by_permission_api'])->name('api.get_buffet_permission');
// });