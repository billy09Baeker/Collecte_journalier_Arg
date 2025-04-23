<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UtilisateurController extends Controller
{
    public function index()
    {
        return Utilisateur::all();
    }

    public function show($id)
{
    try {
        return Utilisateur::with(['paiements', 'notifications', 'ajouterPar'])->findOrFail($id);
    } catch (ModelNotFoundException $e) {
        return response()->json(['message' => 'Utilisateur non trouvé.'], 404);
    }
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'date_naissance' => 'nullable|date',
            'lieu_naissance' => 'nullable|string',
            'sexe' => 'nullable|string|in:Homme,Femme',
            'email' => 'required|email|unique:utilisateurs,email',
            'telephone' => 'required|string',
            'adresse' => 'nullable|string',
            'password' => 'required|string|min:6',
            'role' => 'nullable|string|in:admin,client,collecteur',
            'added_by' => 'nullable|exists:utilisateurs,id'
        ]);

        // Appliquer "client" par défaut si aucun rôle n’est fourni
        $validated['role'] = $validated['role'] ?? 'client';

        $utilisateur = Utilisateur::create($validated);

        return response()->json($utilisateur, 201);
    }

    public function update(Request $request, $id)

{

    $utilisateur = Utilisateur::findOrFail($id);


    $validated = $request->validate([
        'nom' => 'sometimes|string',
        'prenom' => 'sometimes|string',
        'date_naissance' => 'nullable|date',
        'lieu_naissance' => 'nullable|string',
        'sexe' => 'nullable|string|in:Homme,Femme',
        'email' => 'sometimes|email|unique:utilisateurs,email,' . $id,
        'telephone' => 'sometimes|string',
        'adresse' => 'nullable|string',
        'role' => 'sometimes|in:admin,collecteur,client',
        'password' => 'sometimes|string|min:6',
        'added_by' => 'nullable|exists:utilisateurs,id'
    ]);



    // Si le mot de passe est présent, le hacher

    if (isset($validated['password'])) {

        $utilisateur->password = $validated['password']; // Utilise le mutateur pour le hachage

    }


    $utilisateur->update($validated);


    return response()->json($utilisateur);

}

    public function destroy($id)
    {
        $utilisateur = Utilisateur::findOrFail($id);
        $utilisateur->delete();

        return response()->json(['message' => 'Utilisateur supprimé avec succès.']);
    }

    // 🔁 Clients ajoutés par un collecteur
    public function clientsParCollecteur($id)
    {
        $collecteur = Utilisateur::findOrFail($id);

        if ($collecteur->role !== 'collecteur') {
            return response()->json(['message' => 'Cet utilisateur n’est pas un collecteur'], 403);
        }

        return $collecteur->clientsAjoutes;
    }

    /**
 * Affiche la liste de tous les clients.
 */
public function listeClients()
{
    // Récupérer tous les utilisateurs ayant le rôle de « client ».
    $clients = Utilisateur::where('role', 'client')->get();

    // Vérifier s'il y a des clients
    if ($clients->isEmpty()) {
        return response()->json(['message' => 'Aucun client trouvé.'], 404);
    }

    return response()->json($clients, 200);
}

/**
 * Affiche la liste de tous les collecteurs.
 */
public function listeCollecteurs()
{
    // Récupérer tous les utilisateurs ayant le rôle de « collecteur ».
    $collecteurs = Utilisateur::where('role', 'collecteur')->get();

    // Vérifier s'il y a des collecteurs
    if ($collecteurs->isEmpty()) {
        return response()->json(['message' => 'Aucun collecteur trouvé.'], 404);
    }

    return response()->json($collecteurs, 200);
}

}
