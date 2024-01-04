<?php

use App\Http\Controllers\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Rotas protegidas por autenticação do Sanctum e de sessão
    // Pode ser usado para rotas que respondem tanto a solicitações tradicionais quanto a solicitações AJAX na sua SPA
    Route::get('/api/me', 'UserController@me'); // Exemplo de rota protegida por Sanctum
    // Adicione outras rotas protegidas por autenticação do Sanctum aqui
});


Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/permissions/{permission}', [SubscriptionController::class, 'get_roles_by_permission_api'])->name('api.get_buffet_permission');
});