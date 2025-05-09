<?php

//use App\Http\Controllers\API\UtilisateurController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\API\PaiementControllerApi;
use App\Http\Controllers\API\RecuControllerApi;
use App\Http\Controllers\API\NotificationControllerApi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EcheanceController;
use App\Http\Controllers\PaiementController;
use App\Models\Utilisateur;

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
})->name('register')->middleware('guest');


Route::post('/register', [UtilisateurController::class, 'register'])->name('register');


Route::middleware(['auth'])->group(function () {



    Route::get('/collecteur/home', function () {
        return view('collecteur.home');
    })->name('collecteur.home');



    Route::get('/client/home', [UtilisateurController::class, 'dashboardClient'])->name('client.home');


    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




    Route::post('/client/paiements/store', [PaiementController::class, 'storePaiement'])->name('client.paiements.store');



    Route::get('/client/mes-paiements', [PaiementController::class, 'getMesPaiement'])->name('client.mes-paiements');


    Route::post('/paiements/store', [PaiementController::class, 'storePaiement'])->name('paiements.store');



    Route::get('/admin/dashboard', [UtilisateurController::class, 'dashboardAdmin'])->name('admin.dashboard');

    Route::get('/admin', [UtilisateurController::class, 'gestionCollecteur'])->name('admin.collecteurs');

    Route::post('/admin/collecteur/store', [UtilisateurController::class, 'storeCollecteur'])->name('admin.collecteur.store');

    Route::get('/admin/collecteur/edit/{id}', [UtilisateurController::class, 'editCollecteur'])->name('admin.collecteur.edit');

    Route::put('/admin/collecteur/update/{id}', [UtilisateurController::class, 'updateCollecteur'])->name('admin.collecteur.update');

    Route::delete('/admin/collecteur/delete/{id}', [UtilisateurController::class, 'destroyCollecteur'])->name('collecteurs.destroy');

    Route::get('/admin/clients', [UtilisateurController::class, 'getListClients'])->name('admin.clients');


    Route::delete('/admin/client/delete/{id}', [UtilisateurController::class, 'destroyCollecteur'])->name('client.destroy');


    Route::get('/admin/clients/{id}/details', [UtilisateurController::class, 'getDetailsClient'])->name('client.details');

    Route::get('/admin/suivi-paiements', [PaiementController::class, 'getSuiviPaiement'])->name('admin.suivi-paiements');


    Route::get('/admin/performances', [UtilisateurController::class, 'getPerformanceCollecteur'])->name('admin.performances');



    Route::get('/admin/collecteurs/{id}/details', [UtilisateurController::class, 'getDetailsPerformance'])->name('collecteur.details');





    Route::get('/admin/parametres', [EcheanceController::class, 'getParametre'])->name('admin.parametres');


    Route::post('/admin/parametres/update', [EcheanceController::class, 'updateEcheance'])->name('admin.parametres.update');


    Route::post('/admin/parametres/store', [EcheanceController::class, 'storeEcheance'])->name('admin.parametres.store');


    Route::post('/paiements/{id}/confirmer', [PaiementController::class, 'confirmerPaiement'])->name('paiement.confirmer');


    Route::post('/paiements/{id}/annuler', [PaiementController::class, 'annulerPaiement'])->name('paiement.annuler');





    Route::get('/collecteur/dashboard', [UtilisateurController::class, 'dashboardCollecteur'])->name('collecteur.dashboard');



    Route::get('/collecteur/paiements', [PaiementController::class, 'getPaiementByCollecteur'])->name('collecteur.paiements');


    Route::post('/collecteur/paiements/store', [PaiementController::class, 'storePaiementByCollecteur'])->name('collecteur.paiements.store');



    Route::get('/collecteur/paiements/{id}/recu', [PaiementController::class, 'telechargerRecu'])->name('collecteur.paiements.recu');


    Route::get('/collecteur/clients', [UtilisateurController::class, 'getClient'])->name('collecteur.clients');




    Route::post('/collecteur/clients/store', [UtilisateurController::class, 'storeClient'])->name('collecteur.client.store');

    Route::put('/collecteur/clients/add/{id}', [UtilisateurController::class, 'updateClient'])->name('collecteur.client.update');


    Route::get('/collecteur/performances', [UtilisateurController::class, 'mesPerformances'])->name('collecteur.performances');
});
