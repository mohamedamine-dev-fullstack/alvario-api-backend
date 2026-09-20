<?php

namespace App\Http\Controllers;

use App\Models\VarianteProduit;
use Illuminate\Http\Request;

class VarianteProduitController extends Controller
{
    public function index()
    {
        $variantes = VarianteProduit::with('produit')->get();

        return response()->json($variantes);
    }

    public function show($id)
    {
        $variante = VarianteProduit::with('produit')->find($id);

        if (!$variante) {
            return response()->json([
                'message' => 'Variante introuvable'
            ], 404);
        }

        return response()->json($variante);
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'taille' => 'nullable|string|max:100',
            'couleur' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        $variante = VarianteProduit::create([
            'produit_id' => $request->produit_id,
            'taille' => $request->taille,
            'couleur' => $request->couleur,
            'stock' => $request->stock,
        ]);

        return response()->json([
            'message' => 'Variante créée avec succès',
            'variante' => $variante
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $variante = VarianteProduit::find($id);

        if (!$variante) {
            return response()->json([
                'message' => 'Variante introuvable'
            ], 404);
        }

        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'taille' => 'nullable|string|max:100',
            'couleur' => 'nullable|string|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        $variante->update([
            'produit_id' => $request->produit_id,
            'taille' => $request->taille,
            'couleur' => $request->couleur,
            'stock' => $request->stock,
        ]);

        return response()->json([
            'message' => 'Variante modifiée avec succès',
            'variante' => $variante
        ]);
    }

    public function destroy($id)
    {
        $variante = VarianteProduit::find($id);

        if (!$variante) {
            return response()->json([
                'message' => 'Variante introuvable'
            ], 404);
        }

        $variante->delete();

        return response()->json([
            'message' => 'Variante supprimée avec succès'
        ]);
    }
}
