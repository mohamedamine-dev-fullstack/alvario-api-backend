<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();

        return response()->json($categories);
    }

    public function show(int $id)
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        $categorie = Categorie::create([
            'nom' => $request->nom,
            'slug' => $request->slug,
            'image' => $request->hasFile('image')
                ? $request->file('image')->store('categories', 'public')
                : null,
        ]);

        return response()->json([
            'message' => 'Catégorie créée avec succès',
            'categorie' => $categorie
        ], 201);
    }

    public function update(Request $request, int $id)
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
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        /*$categorie->update([
            'nom' => $request->nom,
            'slug' => $request->slug,
            'image' => $request->image,
        ]);*/
        $donnees = [
            'nom' => $request->nom,
            'slug' => $request->slug,
        ];

        if ($request->hasFile('image')) {
            if ($categorie->image) {
                Storage::disk('public')->delete($categorie->image);
            }

            $donnees['image'] = $request->file('image')
                ->store('categories', 'public');
        }

        $categorie->update($donnees);

        return response()->json([
            'message' => 'Catégorie modifiée avec succès',
            'categorie' => $categorie
        ]);
    }

    public function destroy(int $id)
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
