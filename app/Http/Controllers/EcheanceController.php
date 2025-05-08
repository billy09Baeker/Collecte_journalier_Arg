<?php

namespace App\Http\Controllers;

use App\Models\Echeance;
use Illuminate\Http\Request;

class EcheanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function getParametre()
    {

        $echeance = Echeance::first();

        return view('admin.parametres', compact('echeance'));
    }



public function storeEcheance(Request $request)
{
    $request->validate([
        'montant_journalier' => 'required|numeric|min:0',
        'date_paiement' => 'required|date',
        'date_echeance' => 'required|date',
        'mode_paiement_1' => 'nullable|string',
        'qr_code_1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validation pour les images
        'mode_paiement_2' => 'nullable|string',
        'qr_code_2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validation pour les images
    ]);

    $data = $request->all();

    // Gestion des uploads
    if ($request->hasFile('qr_code_1')) {
        $data['qr_code_1'] = $request->file('qr_code_1')->store('qr_codes', 'public');
    }

    if ($request->hasFile('qr_code_2')) {
        $data['qr_code_2'] = $request->file('qr_code_2')->store('qr_codes', 'public');
    }

    Echeance::create($data);

    return redirect()->back()->with('success', 'Échéance créée avec succès.');
}

    /**
     * Display the specified resource.
     */

    public function updateEcheance(Request $request)
    {
        $request->validate([
            'montant_journalier' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
            'date_echeance' => 'required|date',
            'mode_paiement_1' => 'nullable|string',
            'qr_code_1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'mode_paiement_2' => 'nullable|string',
            'qr_code_2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $echeance = Echeance::first();

        if ($request->hasFile('qr_code_1')) {
            $echeance->qr_code_1 = $request->file('qr_code_1')->store('qr_codes', 'public');
        }

        if ($request->hasFile('qr_code_2')) {
            $echeance->qr_code_2 = $request->file('qr_code_2')->store('qr_codes', 'public');
        }

        $echeance->update($request->except(['qr_code_1', 'qr_code_2']));

        return redirect()->route('admin.parametres')->with('success', 'Échéance mise à jour avec succès.');
    }

    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
