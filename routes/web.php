<?php

use App\Http\Controllers\API\UtilisateurController;
use App\Http\Controllers\API\PaiementController;
use App\Http\Controllers\API\RecuController;
use App\Http\Controllers\API\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('utilisateurs')->group(function () {
    Route::get('/', [UtilisateurController::class, 'index']);
    Route::get('/{id}', [UtilisateurController::class, 'show']);
    Route::post('/', [UtilisateurController::class, 'store']);
    Route::put('/{id}', [UtilisateurController::class, 'update']);
    Route::delete('/{id}', [UtilisateurController::class, 'destroy']);

    Route::get('/{id}/clients', [UtilisateurController::class, 'clientsParCollecteur']);
    Route::get('/clients', [UtilisateurController::class, 'listeClients']);
    Route::get('/collecteurs', [UtilisateurController::class, 'listeCollecteurs']);
});

Route::prefix('paiements')->group(function () {
    Route::get('/', [PaiementController::class, 'index']);
    Route::get('/{id}', [PaiementController::class, 'show']);
    Route::post('/', [PaiementController::class, 'store']);
    Route::put('/{id}', [PaiementController::class, 'update']);
    Route::delete('/{id}', [PaiementController::class, 'destroy']);
    Route::get('/client/{clientId}', [PaiementController::class, 'paiementsParClient']);
    Route::get('paiements/collecteur/{collecteurId}', [PaiementController::class, 'paiementsParCollecteur']);
});

Route::prefix('recus')->group(function () {
    Route::get('/', [RecuController::class, 'index']);
    Route::get('/{id}', [RecuController::class, 'show']);
    Route::post('/', [RecuController::class, 'store']);
    Route::put('/{id}', [RecuController::class, 'update']);
    Route::delete('/{id}', [RecuController::class, 'destroy']);
});

Route::prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index']);
    Route::get('/{id}', [NotificationController::class, 'show']);
    Route::post('/', [NotificationController::class, 'store']);
    Route::put('/{id}', [NotificationController::class, 'update']);
    Route::delete('/{id}', [NotificationController::class, 'destroy']);
});


Route::get('/', function () {
    return view('welcome');
});
