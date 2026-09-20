<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with(['categorie', 'images', 'variantes'])->get();

        return response()->json($produits);
    }

    public function show($id)
    {
        $produit = Produit::with(['categorie', 'images', 'variantes'])->find($id);

        if (!$produit) {
            return response()->json([
                'message' => 'Produit introuvable'
            ], 404);
        }

        return response()->json($produit);
    }

    public function store(Request $request)
    {
        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:produits,slug',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'ancien_prix' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'statut' => 'required|string|max:50',
        ]);

        $produit = Produit::create([
            'categorie_id' => $request->categorie_id,
            'nom' => $request->nom,
            'slug' => $request->slug,
            'description' => $request->description,
            'prix' => $request->prix,
            'ancien_prix' => $request->ancien_prix,
            'stock' => $request->stock,
            'statut' => $request->statut,
        ]);

        return response()->json([
            'message' => 'Produit créé avec succès',
            'produit' => $produit
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json([
                'message' => 'Produit introuvable'
            ], 404);
        }

        $request->validate([
            'categorie_id' => 'required|exists:categories,id',
            'nom' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:produits,slug,' . $id,
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'ancien_prix' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'statut' => 'required|string|max:50',
        ]);

        $produit->update([
            'categorie_id' => $request->categorie_id,
            'nom' => $request->nom,
            'slug' => $request->slug,
            'description' => $request->description,
            'prix' => $request->prix,
            'ancien_prix' => $request->ancien_prix,
            'stock' => $request->stock,
            'statut' => $request->statut,
        ]);

        return response()->json([
            'message' => 'Produit modifié avec succès',
            'produit' => $produit
        ]);
    }

    public function destroy($id)
    {
        $produit = Produit::find($id);

        if (!$produit) {
            return response()->json([
                'message' => 'Produit introuvable'
            ], 404);
        }

        $produit->delete();

        return response()->json([
            'message' => 'Produit supprimé avec succès'
        ]);
    }
}
