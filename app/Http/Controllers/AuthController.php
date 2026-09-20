<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:utilisateurs,email',
            'mot_de_passe' => 'required|string|min:6',
            'telephone' => 'nullable|string|max:20',
        ]);

        $utilisateur = Utilisateur::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'mot_de_passe' => Hash::make($request->mot_de_passe),
            'telephone' => $request->telephone,
            'role' => 'client',
        ]);

        $token = $utilisateur->createToken('alvario-token')->plainTextToken;

        return response()->json([
            'message' => 'Inscription réussie',
            'utilisateur' => $utilisateur,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'mot_de_passe' => 'required|string',
        ]);

        $utilisateur = Utilisateur::where('email', $request->email)->first();

        if (!$utilisateur || !Hash::check($request->mot_de_passe, $utilisateur->mot_de_passe)) {
            return response()->json([
                'message' => 'Email ou mot de passe incorrect'
            ], 401);
        }

        $token = $utilisateur->createToken('alvario-token')->plainTextToken;

        return response()->json([
            'message' => 'Connexion réussie',
            'utilisateur' => $utilisateur,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie'
        ]);
    }

    public function profile(Request $request)
    {
        return response()->json([
            'utilisateur' => $request->user()
        ]);
    }
}
