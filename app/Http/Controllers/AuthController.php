<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Paiement;
use App\Models\Notification;
use App\Models\Recu;
use App\Models\Echeance;

class AuthController extends Controller
{
    public function login(Request $request)
{
    // Validation des champs
    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    // Vérifie les identifiants
    if (!Auth::attempt($request->only('email', 'password'))) {
        return redirect()->back()->withErrors(['message' => 'Identifiants invalides']);
    }

    // Récupère l'utilisateur
    $user = Utilisateur::where('email', $request->email)->first();

    // Authentifie l'utilisateur
    Auth::login($user);

    // Stocke les infos dans la session
    session([
        'user_id' => $user->id,
        'user_nom' => $user->nom,
        'user_prenom' => $user->prenom,

    ]);

    $echeances = Echeance::all();
    $echeance_montant = $echeances->first()->montant_journalier ?? '';
    $echeance_date = $echeances->first()->date_echeance ?? '';

    // Define $user_id before using it
    $user_id = $user->id;

    $lastPayment = Paiement::where('client_id', $user_id)
        ->where('status', 'confirmé')
        ->orderBy('date_paiement', 'desc')
        ->first();
    $lastPayment_montant = $lastPayment ? $lastPayment->montant : 0;
    $lastPayment_date = $lastPayment ? $lastPayment->date_paiement : null;


    // Redirige en fonction du rôle
    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'collecteur':
            return redirect()->route('collecteur.dashboard');
        case 'client':
            // Récupère l'ID de l'utilisateur connecté
            return redirect()->route('client.home');

        default:
            return redirect()->intended('home');
    }
}


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Déconnexion réussie.');
    }
}
