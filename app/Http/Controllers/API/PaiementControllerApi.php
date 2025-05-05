<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Paiement;
use Illuminate\Http\Request;
//use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response;

class PaiementControllerApi extends Controller
{
    /**
     * Display a listing of the paiements.
     */
    public function index()
    {
        $paiements = Paiement::all();
        return response()->json($paiements, Response::HTTP_OK);
    }

    /**
     * Store a newly created paiement in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'montant' => 'required|numeric',
            'date_paiement' => 'required|date',
            'mode_paiement' => 'required|string|max:255',
            'client_id' => 'required|integer|exists:utilisateurs,id',
            'collecteur_id' => 'required|integer|exists:utilisateurs,id',
            'methode_paiement' => 'required|string|max:255',
        ]);

        $paiement = Paiement::create($validatedData);

        return response()->json($paiement, Response::HTTP_CREATED);
    }

    /**
     * Display the specified paiement.
     */
    public function show($id)
    {
        $paiement = Paiement::find($id);

        if (!$paiement) {
            return response()->json(['message' => 'Paiement not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($paiement, Response::HTTP_OK);
    }

    /**
     * Update the specified paiement in storage.
     */
    public function update(Request $request, $id)
    {
        $paiement = Paiement::find($id);

        if (!$paiement) {
            return response()->json(['message' => 'Paiement not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'montant' => 'sometimes|required|numeric',
            'date_paiement' => 'sometimes|required|date',
            'mode_paiement' => 'sometimes|required|string|max:255',
            'client_id' => 'sometimes|required|integer|exists:utilisateurs,id',
            'collecteur_id' => 'sometimes|required|integer|exists:utilisateurs,id',
            'methode_paiement' => 'sometimes|required|string|max:255',
        ]);

        $paiement->update($validatedData);

        return response()->json($paiement, Response::HTTP_OK);
    }

    /**
     * Remove the specified paiement from storage.
     */
    public function destroy($id)
    {
        $paiement = Paiement::find($id);

        if (!$paiement) {
            return response()->json(['message' => 'Paiement not found'], Response::HTTP_NOT_FOUND);
        }

        $paiement->delete();

        return response()->json(['message' => 'Paiement deleted successfully'], Response::HTTP_OK);
    }

    /**
     * Obtenir le paiement par l'ID du client.
     */
    public function paiementsParClient($clientId)
    {
        // Récupérer tous les paiements pour l'identifiant du client donné
        $paiements = Paiement::where('client_id', $clientId)->get();

        // Vérifier si le client a des paiements
        if ($paiements->isEmpty()) {
            return response()->json(['message' => 'Aucun paiement trouvé pour ce client'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($paiements, Response::HTTP_OK);
    }

    /**
 * Affiche la liste des paiements pour les clients enregistrés par un collecteur spécifique.
 */
public function paiementsParCollecteur($collecteurId)
{
    // Récupérer tous les paiements pour lesquels l'identifiant du collecteur correspond à l'identifiant donné.
    $paiements = Paiement::where('collecteur_id', $collecteurId)->get();

    // Vérifier si le collecteur a des paiements
    if ($paiements->isEmpty()) {
        return response()->json(['message' => 'No paiements found for this collecteur'], Response::HTTP_NOT_FOUND);
    }

    return response()->json($paiements, Response::HTTP_OK);
}
}


