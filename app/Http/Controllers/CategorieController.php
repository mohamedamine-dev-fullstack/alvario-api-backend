<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();

        return response()->json($categories);
    }

    public function show($id)
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json([
                'message' => 'Catégorie introuvable'
            ], 404);
        }

        return response()->json($categorie);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'image' => 'nullable|string|max:255',
        ]);

        $categorie = Categorie::create([
            'nom' => $request->nom,
            'slug' => $request->slug,
            'image' => $request->image,
        ]);

        return response()->json([
            'message' => 'Catégorie créée avec succès',
            'categorie' => $categorie
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json([
                'message' => 'Catégorie introuvable'
            ], 404);
        }

        $request->validate([
            'nom' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug,' . $id,
            'image' => 'nullable|string|max:255',
        ]);

        $categorie->update([
            'nom' => $request->nom,
            'slug' => $request->slug,
            'image' => $request->image,
        ]);

        return response()->json([
            'message' => 'Catégorie modifiée avec succès',
            'categorie' => $categorie
        ]);
    }

    public function destroy($id)
    {
        $categorie = Categorie::find($id);

        if (!$categorie) {
            return response()->json([
                'message' => 'Catégorie introuvable'
            ], 404);
        }

        $categorie->delete();

        return response()->json([
            'message' => 'Catégorie supprimée avec succès'
        ]);
    }
}
