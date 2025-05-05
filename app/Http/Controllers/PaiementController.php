<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Paiement;
use App\Models\Notification;
use App\Models\Recu;
use Illuminate\Support\Facades\Auth;
use App\Models\Echeance;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index(Request $request)
     {
        $client = Auth::user(); // Récupérer le client authentifié
         $paiements = Paiement::where('client_id', $client->id)->orderBy('date_paiement', 'desc')->take(10)->get(); // Derniers paiements

        $echeances = Echeance::all();



         return view('client.paiements', compact('client', 'paiements', 'echeances'));
     }

     /**
 * Enregistrer un nouveau paiement.
 */
    public function storePaiement(Request $request)
    {
        $request->validate([
            'montant' => 'required|numeric|min:1',
            'mode_paiement' => 'required|string',
            'client_id' => 'required|exists:utilisateurs,id',
        ]);

        Paiement::create([
            'montant' => $request->montant,
            'date_paiement' => now(),
            'mode_paiement' => $request->mode_paiement,
            'client_id' => $request->client_id,
            'collecteur_id' => null, // Collecteur vide
            'status' => 'en attente', // Statut par défaut
        ]);

        return redirect()->back()->with('success', 'Paiement enregistré avec succès.');
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
