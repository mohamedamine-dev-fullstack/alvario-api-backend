<?php

namespace App\Http\Controllers;

use App\Models\ImageProduit;
use Illuminate\Http\Request;

class ImageProduitController extends Controller
{
    public function index()
    {
        $images = ImageProduit::with('produit')->get();

        return response()->json($images);
    }

    public function show($id)
    {
        $image = ImageProduit::with('produit')->find($id);

        if (!$image) {
            return response()->json([
                'message' => 'Image introuvable'
            ], 404);
        }

        return response()->json($image);
    }

    public function store(Request $request)
    {
        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'image' => 'required|string|max:255',
        ]);

        $image = ImageProduit::create([
            'produit_id' => $request->produit_id,
            'image' => $request->image,
        ]);

        return response()->json([
            'message' => 'Image ajoutée avec succès',
            'image' => $image
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $image = ImageProduit::find($id);

        if (!$image) {
            return response()->json([
                'message' => 'Image introuvable'
            ], 404);
        }

        $request->validate([
            'produit_id' => 'required|exists:produits,id',
            'image' => 'required|string|max:255',
        ]);

        $image->update([
            'produit_id' => $request->produit_id,
            'image' => $request->image,
        ]);

        return response()->json([
            'message' => 'Image modifiée avec succès',
            'image' => $image
        ]);
    }

    public function destroy($id)
    {
        $image = ImageProduit::find($id);

        if (!$image) {
            return response()->json([
                'message' => 'Image introuvable'
            ], 404);
        }

        $image->delete();

        return response()->json([
            'message' => 'Image supprimée avec succès'
        ]);
    }
}
