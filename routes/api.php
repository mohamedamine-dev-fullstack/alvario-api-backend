<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ImageProduitController;
use App\Http\Controllers\VarianteProduitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommandeController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
});

Route::apiResource('categories', CategorieController::class);

Route::apiResource('produits', ProduitController::class);

Route::apiResource('images-produit', ImageProduitController::class);

Route::apiResource('variantes-produit', VarianteProduitController::class);

// Enregistrer une commande client
Route::post('/commandes', [CommandeController::class, 'store']);

// Routes réservées à l'administrateur
Route::middleware(['auth:sanctum', 'admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/commandes', [CommandeController::class, 'index']);
        Route::get('/commandes/{commande}', [CommandeController::class, 'show']);
        Route::patch('/commandes/{commande}/statut', [CommandeController::class, 'updateStatut']);
    });
