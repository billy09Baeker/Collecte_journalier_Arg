<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Recu;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RecuController extends Controller
{
    /**
     * Display a listing of the recus.
     */
    public function index()
    {
        $recus = Recu::all();
        return response()->json($recus, Response::HTTP_OK);
    }

    /**
     * Store a newly created recu in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'numero_recu' => 'required|string|max:255',
            'paiement_id' => 'required|integer|exists:paiements,id',
            'date_emission' => 'required|date',
        ]);

        $recu = Recu::create($validatedData);

        return response()->json($recu, Response::HTTP_CREATED);
    }

    /**
     * Display the specified recu.
     */
    public function show($id)
    {
        $recu = Recu::find($id);

        if (!$recu) {
            return response()->json(['message' => 'Recu not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($recu, Response::HTTP_OK);
    }

    /**
     * Update the specified recu in storage.
     */
    public function update(Request $request, $id)
    {
        $recu = Recu::find($id);

        if (!$recu) {
            return response()->json(['message' => 'Recu not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'numero_recu' => 'sometimes|required|string|max:255',
            'paiement_id' => 'sometimes|required|integer|exists:paiements,id',
            'date_emission' => 'sometimes|required|date',
        ]);

        $recu->update($validatedData);

        return response()->json($recu, Response::HTTP_OK);
    }

    /**
     * Remove the specified recu from storage.
     */
    public function destroy($id)
    {
        $recu = Recu::find($id);

        if (!$recu) {
            return response()->json(['message' => 'Recu not found'], Response::HTTP_NOT_FOUND);
        }

        $recu->delete();

        return response()->json(['message' => 'Recu deleted successfully'], Response::HTTP_OK);
    }
}
