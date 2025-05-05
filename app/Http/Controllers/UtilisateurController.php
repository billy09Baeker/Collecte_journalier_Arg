<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;

class UtilisateurController extends Controller
{

    //Create register function


    public function register(Request $request)
{
    // Validation des données du formulaire
    $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'date_naissance' => 'required|date',
        'lieu_naissance' => 'required|string|max:255',
        'sexe' => 'required|in:masculin,feminin',
        'email' => 'required|email|unique:users,email',
        'telephone' => 'required|string|max:15',
        'adresse' => 'required|string|max:255',
        'password' => 'required|string|confirmed|min:8',
    ]);

    // Création de l'utilisateur
    $user = Utilisateur::create([
        'nom' => $request->nom,
        'prenom' => $request->prenom,
        'date_naissance' => $request->date_naissance,
        'lieu_naissance' => $request->lieu_naissance,
        'sexe' => $request->sexe,
        'email' => $request->email,
        'telephone' => $request->telephone,
        'adresse' => $request->adresse,
        'password' => $request->password,
        'role' => 'client', // Rôle par défaut
        'added_by' => null, // Champ laissé vide
    ]);

    // Redirection après inscription
    return redirect()->route('login')->with('success', 'Inscription réussie. Vous pouvez maintenant vous connecter.');
}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
