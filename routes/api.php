<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ImageProduitController;
use App\Http\Controllers\VarianteProduitController;
use App\Http\Controllers\AuthController;

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
