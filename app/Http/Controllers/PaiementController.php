<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use App\Models\Paiement;
use App\Models\Notification;
use App\Models\Recu;
use Illuminate\Support\Facades\Auth;
use App\Models\Echeance;
use Barryvdh\DomPDF\Facade\Pdf;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function getMesPaiement(Request $request)
    {
        $client = Auth::user(); // Récupérer le client connecté
        $status = $request->query('status'); // Récupérer le filtre de statut depuis la requête

        // Récupérer l'échéance unique
        $echeance = Echeance::first();

        // Récupérer les paiements du client connecté, avec un filtre sur le statut si défini
        $paiementsQuery = Paiement::where('client_id', $client->id)->orderBy('date_paiement', 'desc');
        if ($status) {
            $paiementsQuery->where('status', $status);
        }
        $paiements = $paiementsQuery->paginate(10);

        return view('client.paiements', compact('echeance', 'paiements', 'status'));
    }

     /**
 * Enregistrer un nouveau paiement.
 */

    public function storePaiement(Request $request)
    {
        $client = Auth::user(); // Récupérer le client connecté
        $echeance = Echeance::first(); // Récupérer l'échéance unique

        if (!$echeance) {
            return redirect()->back()->with('error', 'Aucune échéance définie.');
        }

        // Enregistrer le paiement
        Paiement::create([
            'montant' => $echeance->montant_journalier,
            'date_paiement' => now(),
            'mode_paiement' => $echeance->mode_paiement_1 ?? 'Non spécifié',
            'client_id' => $client->id,
            'collecteur_id' => null, // À définir selon votre logique
            'status' => 'en attente',
        ]);

        return redirect()->route('client.mes-paiements')->with('success', 'Paiement enregistré avec succès. Vous serez notifié une fois confirmé.');
    }
    /**
     * Show the form for creating a new resource.
     */


     public function getSuiviPaiement(Request $request, $status = null)
     {
         // Compteurs pour les paiements
         $totalPaiementsConfirmes = Paiement::where('status', 'confirmé')->count();
         $totalPaiementsEnattentes = Paiement::where('status', 'en attente')->count();
         $totalPaiementsAnnules = Paiement::where('status', 'annulé')->count();

         $status = $request->query('status'); 

         // Filtrer les paiements en fonction du statut
         $paiementsQuery = Paiement::with('client')->orderBy('date_paiement', 'desc');
         if ($status) {
             $paiementsQuery->where('status', $status);
         }
         $paiements = $paiementsQuery->paginate(10); // Pagination de 10 paiements par page

         return view('admin.suivi-transaction', compact(
             'totalPaiementsConfirmes',
             'totalPaiementsEnattentes',
             'totalPaiementsAnnules',
             'paiements',
             'status'
         ));
     }



    public function confirmerPaiement($id)
    {
        // Récupérer le paiement par son ID
        $paiement = Paiement::findOrFail($id);

        // Vérifier si le paiement est en attente
        if ($paiement->status !== 'en attente') {
            return redirect()->back()->with('error', 'Seuls les paiements en attente peuvent être confirmés.');
        }

        // Mettre à jour le statut du paiement
        $paiement->update(['status' => 'confirmé']);

        return redirect()->back()->with('success', 'Paiement confirmé avec succès.');
    }


    public function annulerPaiement($id)
    {
        // Récupérer le paiement par son ID
        $paiement = Paiement::findOrFail($id);

        // Vérifier si le paiement est en attente
        if ($paiement->status !== 'en attente') {
            return redirect()->back()->with('error', 'Seuls les paiements en attente peuvent être annulés.');
        }

        // Mettre à jour le statut du paiement
        $paiement->update(['status' => 'annulé']);

        return redirect()->back()->with('success', 'Paiement annulé avec succès.');
    }


    public function getPaiementByCollecteur()
    {
        $collecteur_id = Auth::id(); // Récupérer l'ID du collecteur connecté

        // Récupérer tous les clients du système, triés par ordre alphabétique
        $clients = Utilisateur::where('role', 'client')
            ->orderBy('nom', 'asc')
            ->get();

        // Récupérer l'échéance unique
        $echeance = Echeance::first();

        // Récupérer tous les paiements effectués par le collecteur
        $paiements = Paiement::where('collecteur_id', $collecteur_id)
            ->orderBy('date_paiement', 'desc')
            ->paginate(10); // Pagination de 10 paiements par page

        return view('collecteur.paiements', compact('clients', 'echeance', 'paiements'));
    }



public function storePaiementByCollecteur(Request $request)
{
    $request->validate([
        'client_id' => 'required|exists:utilisateurs,id',
        'mode_paiement' => 'required|in:espece,mobile money,virement',
    ]);

    $collecteur_id = Auth::id(); // Récupérer l'ID du collecteur connecté
    $echeance = Echeance::first(); // Récupérer l'échéance unique

    if (!$echeance) {
        return redirect()->back()->with('error', 'Aucune échéance définie.');
    }

    // Enregistrer le paiement
    Paiement::create([
        'montant' => $echeance->montant_journalier,
        'date_paiement' => now(),
        'mode_paiement' => $request->mode_paiement,
        'client_id' => $request->client_id,
        'collecteur_id' => $collecteur_id,
        'status' => 'confirmé',
    ]);

    return redirect()->route('collecteur.paiements')->with('success', 'Paiement enregistré avec succès.');
}


public function telechargerRecu($id)
{
    $paiement = Paiement::with('client')->findOrFail($id);

    // Générer un reçu (par exemple, en PDF)
    $pdf = Pdf::loadView('collecteur.recu', compact('paiement'));

    return $pdf->download('recu_paiement_' . $paiement->id . '.pdf');
}



}
