<?php

//use App\Http\Controllers\API\UtilisateurController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\API\PaiementControllerApi;
use App\Http\Controllers\API\RecuControllerApi;
use App\Http\Controllers\API\NotificationControllerApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaiementController;


Route::post('/login', [AuthController::class, 'login'])->name('login');


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
    Route::get('/', [PaiementControllerApi::class, 'index']);
    Route::get('/{id}', [PaiementControllerApi::class, 'show']);
    Route::post('/', [PaiementControllerApi::class, 'store']);
    Route::put('/{id}', [PaiementControllerApi::class, 'update']);
    Route::delete('/{id}', [PaiementControllerApi::class, 'destroy']);
    Route::get('/client/{clientId}', [PaiementControllerApi::class, 'paiementsParClient']);
    Route::get('paiements/collecteur/{collecteurId}', [PaiementControllerApi::class, 'paiementsParCollecteur']);
});

Route::prefix('recus')->group(function () {
    Route::get('/', [RecuControllerApi::class, 'index']);
    Route::get('/{id}', [RecuControllerApi::class, 'show']);
    Route::post('/', [RecuControllerApi::class, 'store']);
    Route::put('/{id}', [RecuControllerApi::class, 'update']);
    Route::delete('/{id}', [RecuControllerApi::class, 'destroy']);
});

Route::prefix('notifications')->group(function () {
    Route::get('/', [NotificationControllerApi::class, 'index']);
    Route::get('/{id}', [NotificationControllerApi::class, 'show']);
    Route::post('/', [NotificationControllerApi::class, 'store']);
    Route::put('/{id}', [NotificationControllerApi::class, 'update']);
    Route::delete('/{id}', [NotificationControllerApi::class, 'destroy']);
});

///////////////////////////////////////////////////////////////////////////



Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('register');
})->name('register');


Route::post('/register', [UtilisateurController::class, 'register'])->name('register');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/home', function () {
        return view('admin.home');
    })->name('admin.home');



    Route::get('/collecteur/home', function () {
        return view('collecteur.home');
    })->name('collecteur.home');



    Route::get('/client/home', function () {
        return view('client.home');
    })->name('client.home');


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/client/paiements', [PaiementController::class, 'index'])->name('client.paiements');

    Route::post('/paiements/store', [PaiementController::class, 'storePaiement'])->name('paiements.store');
});
