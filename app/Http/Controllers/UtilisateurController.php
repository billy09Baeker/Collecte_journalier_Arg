<?php

namespace App\Http\Controllers;

use App\Models\Echeance;
use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Paiement;

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



    public function storeCollecteur(Request $request)
    {
    // Validation des données du formulaire
    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'date_naissance' => 'required|date',
        'lieu_naissance' => 'required|string|max:255',
        'sexe' => 'required|in:masculin,féminin',
        'email' => 'required|email|unique:users,email',
        'telephone' => 'required|string|max:15',
        'adresse' => 'required|string|max:255',
        'password' => 'required|string|min:8', // Si tu veux confirmation
    ]);

    // Création de l'utilisateur avec rôle collecteur
    $user = Utilisateur::create([
        'nom' => $validated['nom'],
        'prenom' => $validated['prenom'],
        'date_naissance' => $validated['date_naissance'],
        'lieu_naissance' => $validated['lieu_naissance'],
        'sexe' => $validated['sexe'],
        'email' => $validated['email'],
        'telephone' => $validated['telephone'],
        'adresse' => $validated['adresse'],
        'password' => $validated['password'],
        'role' => 'collecteur', // Si tu as une colonne "role" simple
        'added_by' => session('user_id'), // ID de l'utilisateur connecté
    ]);

    return redirect()->route('admin.collecteurs')->with('success', 'Collecteur ajouté avec succès.');
}

    /**
     * Display a listing of the resource.
     */


     public function dashboardAdmin()
    {
        $totalCollecteurs = Utilisateur::where('role', 'collecteur')->count();
        $totalClients = Utilisateur::where('role', 'client')->count();

        return view('admin.dashboard', compact('totalCollecteurs', 'totalClients'));
    }





    public function dashboardClient()
{
    $user_id = session('user_id');

    // Total des paiements confirmés
    $totalPaiements = Paiement::where('client_id', $user_id)
                        ->where('status', 'confirmé')
                        ->sum('montant');

    // Dernier paiement confirmé
    $lastPayment = Paiement::where('client_id', $user_id)
                        ->where('status', 'confirmé')
                        ->latest()
                        ->first();

    // Prochaine échéance à venir depuis la table échéances
    $echeance = Echeance::whereDate('date_echeance', '>=', now())
                        ->orderBy('date_echeance', 'asc')
                        ->first();

    return view('client.home', [
        'totalPaiements' => $totalPaiements,
        'lastPayment_montant' => $lastPayment->montant ?? 0,
        'lastPayment_date' => optional($lastPayment?->created_at)->format('d/m/Y') ?? '-',

        'echeance_montant' => $echeance->montant_journalier ?? 0,
        'echeance_date' => optional($echeance?->date_echeance)->format('d/m/Y') ?? '-',
    ]);
}

    public function gestionCollecteur()
    {
        $collecteurs = Utilisateur::where('role', 'collecteur')->get();
        return view('admin.collecteurs', compact('collecteurs'));
    }

    public function gestionClient()
    {
        $clients = Utilisateur::where('role', 'client')->get();
        return view('admin.clients', compact('clients'));
    }

    public function editCollecteur($id)
{
    $collecteur = Utilisateur::where('role', 'collecteur')->findOrFail($id);
    return view('admin.collecteur_edit', compact('collecteur'));
}

public function updateCollecteur(Request $request, $id)
{
    $collecteur = Utilisateur::where('role', 'collecteur')->findOrFail($id);

    $validated = $request->validate([
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'date_naissance' => 'required|date',
        'lieu_naissance' => 'required|string|max:255',
        'sexe' => 'required|in:masculin,féminin',
        'email' => 'required|email|unique:users,email,' . $collecteur->id,
        'telephone' => 'required|string|max:15' . $collecteur->id,
        'adresse' => 'nullable|string|max:255',
        'password' => 'nullable|string|min:8', // Facultatif : mot de passe uniquement si rempli
    ]);

    // Mise à jour des champs
    $collecteur->nom = $validated['nom'];
    $collecteur->prenom = $validated['prenom'];
    $collecteur->date_naissance = $validated['date_naissance'];
    $collecteur->lieu_naissance = $validated['lieu_naissance'];
    $collecteur->sexe = $validated['sexe'];
    $collecteur->email = $validated['email'];
    $collecteur->telephone = $validated['telephone'];
    $collecteur->adresse = $validated['adresse'] ?? null;

    // Mise à jour du mot de passe uniquement si fourni
    if (!empty($validated['password'])) {
        $collecteur->password = $validated['password'];
    }

    $collecteur->save();

    return redirect()->route('admin.collecteurs')->with('success', 'Collecteur mis à jour avec succès.');
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
    public function destroyCollecteur($id)
    {
        $collecteur = Utilisateur::findOrFail($id);

        // Optionnel : vérifier le rôle avant suppression
        if ($collecteur->role !== 'collecteur') {
            return redirect()->back()->with('error', 'Cet utilisateur n’est pas un collecteur.');
        }

        $collecteur->delete();

        return redirect()->route('collecteurs.index')->with('success', 'Collecteur supprimé avec succès.');
    }
}
