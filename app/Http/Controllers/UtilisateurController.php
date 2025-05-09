<?php

namespace App\Http\Controllers;

use App\Models\Echeance;
use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;

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
        $user_id = Auth::id(); // Utiliser l'ID de l'utilisateur connecté via Auth

        // Récupérer les données nécessaires
        $totalPaiements = Paiement::where('client_id', $user_id)
            ->where('status', 'confirmé')
            ->sum('montant');

        $lastPayment = Paiement::where('client_id', $user_id)
            ->where('status', 'confirmé')
            ->latest('date_paiement') // Trier par date de paiement
            ->first();

        $echeance = Echeance::whereDate('date_echeance', '>=', now())
            ->orderBy('date_echeance', 'asc')
            ->first();

        // Préparer les données pour la vue
        return view('client.home', [
            'totalPaiements' => $totalPaiements,
            'lastPayment_montant' => $lastPayment->montant ?? 0,
            'lastPayment_date' => optional($lastPayment)->date_paiement
    ? \Carbon\Carbon::parse($lastPayment->date_paiement)->format('d/m/Y')
    : '-',
            'echeance_montant' => $echeance->montant_journalier ?? 0,
            'echeance_date' => optional($echeance)->date_echeance
            ? \Carbon\Carbon::parse($echeance->date_echeance)->format('d/m/Y')
            : '-',
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


    public function destroyClient($id)
    {
        $client = Utilisateur::findOrFail($id);

        // Optionnel : vérifier le rôle avant suppression
        if ($client->role !== 'client') {
            return redirect()->back()->with('error', 'Cet utilisateur n’est pas un client.');
        }

        $client->delete();

        return redirect()->route('  admin.client')->with('success', 'Client supprimé avec succès.');
    }

    public function getListClients()
    {
        // Récupérer tous les clients
        $clients = Utilisateur::where('role', 'client')
            ->with(['paiements' => function ($query) {
                $query->where('status', 'confirmé');
            }])
            ->get()
            ->map(function ($client) {
                // Calculer le solde (somme des paiements confirmés)
                $client->solde = $client->paiements->sum('montant');
                return $client;
            });

        return view('admin.client', compact('clients'));
    }

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


    public function getDetailsClient($id)
    {
        // Récupérer le client par son ID
        $client = Utilisateur::where('role', 'client')->findOrFail($id);

        // Charger les paiements du client
        $paiements = $client->paiements()->orderBy('date_paiement', 'desc')->get();

        return view('admin.client-details', compact('client', 'paiements'));
    }




    public function getPerformanceCollecteur()
    {
        // Récupérer tous les collecteurs
        $collecteurs = Utilisateur::where('role', 'collecteur')
            ->with(['clients.paiements' => function ($query) {
                $query->where('status', 'confirmé'); // Filtrer uniquement les paiements confirmés
            }])
            ->get()
            ->map(function ($collecteur) {
                // Calculer le nombre de clients et le montant total collecté
                $collecteur->nombre_clients = $collecteur->clients->count();
                $collecteur->montant_total_collecte = $collecteur->clients->flatMap->paiements->sum('montant');
                return $collecteur;
            });

        return view('admin.performances', compact('collecteurs'));
    }



    public function getDetailsPerformance($id)
    {
        // Récupérer le collecteur par son ID
        $collecteur = Utilisateur::where('role', 'collecteur')->findOrFail($id);

        // Récupérer les clients ajoutés par ce collecteur
        $clients = $collecteur->clients()
            ->with(['paiements' => function ($query) {
                $query->where('status', 'confirmé'); // Filtrer uniquement les paiements confirmés
            }])
            ->get()
            ->map(function ($client) {
                // Calculer le nombre de paiements confirmés et le montant total des paiements confirmés
                $client->nombre_paiements_confirmes = $client->paiements->count();
                $client->montant_total_paiements = $client->paiements->sum('montant');
                return $client;
            });

        return view('admin.collecteur-details', compact('collecteur', 'clients'));
    }


    public function dashboardCollecteur()
    {
        $collecteur_id = Auth::id(); // Récupérer l'ID du collecteur connecté

        // Récupérer les clients enregistrés par le collecteur
        $clients = Utilisateur::where('added_by', $collecteur_id)
            ->where('role', 'client')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('collecteur.dashboard', compact('clients'));
    }


    public function storeClient(Request $request)
    {

        $user_id = Auth::id(); // Utiliser l'ID de l'utilisateur connecté via Auth
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
        'role' => 'client', // Si tu as une colonne "role" simple
        'added_by' => session('user_id'), // ID de l'utilisateur connecté
    ]);

    return redirect()->route('collecteur.clients')->with('success', 'Client ajouté avec succès.');
}

public function getClient()
    {
        $clients = Utilisateur::where('role', 'client')->get();
        return view('collecteur.clients', compact('clients'));
    }


    public function updateClient(Request $request, $id)
    {
        $client = Utilisateur::where('role', 'collecteur')->findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'date_naissance' => 'required|date',
            'lieu_naissance' => 'required|string|max:255',
            'sexe' => 'required|in:masculin,féminin',
            'email' => 'required|email|unique:users,email,' . $client->id,
            'telephone' => 'required|string|max:15' . $client->id,
            'adresse' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8', // Facultatif : mot de passe uniquement si rempli
        ]);

        // Mise à jour des champs
        $client->nom = $validated['nom'];
        $client->prenom = $validated['prenom'];
        $client->date_naissance = $validated['date_naissance'];
        $client->lieu_naissance = $validated['lieu_naissance'];
        $client->sexe = $validated['sexe'];
        $client->email = $validated['email'];
        $client->telephone = $validated['telephone'];
        $client->adresse = $validated['adresse'] ?? null;

        // Mise à jour du mot de passe uniquement si fourni
        if (!empty($validated['password'])) {
            $client->password = $validated['password'];
        }

        $client->save();

        return redirect()->route('admin.collecteurs')->with('success', 'Client mis à jour avec succès.');
    }

}
