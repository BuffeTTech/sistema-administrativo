<?php

use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(function() {
//     Route::get('/permissions/{permission}', [SubscriptionController::class, 'get_roles_by_permission_api'])->name('api.get_buffet_permission');
// });