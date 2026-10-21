<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\ArticleCommande;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CommandeController extends Controller
{
    // Afficher toutes les commandes pour l'administrateur
    public function index()
    {
        $commandes = Commande::with([
            'articles.produit',
            'utilisateur',
        ])
            ->latest()
            ->paginate(20);

        return response()->json($commandes);
    }

    // Afficher les détails d'une commande
    public function show(Commande $commande)
    {
        $commande->load([
            'articles.produit',
            'utilisateur',
        ]);

        return response()->json([
            'commande' => $commande,
        ]);
    }

    // Modifier le statut d'une commande
    public function updateStatut(
        Request $request,
        Commande $commande
    ) {
        $validated = $request->validate([
            'statut' => [
                'required',
                'string',
                'in:en_attente,confirmee,en_preparation,expediee,livree,annulee',
            ],
        ]);

        $nouveauStatut = $validated['statut'];

        $commande = DB::transaction(function () use (
            $commande,
            $nouveauStatut
        ) {
            $commande = Commande::whereKey($commande->id)
                ->lockForUpdate()
                ->firstOrFail();

            // Une commande annulée ne peut pas être réactivée
            // automatiquement, pour éviter les erreurs de stock.
            if (
                $commande->statut === 'annulee'
                && $nouveauStatut !== 'annulee'
            ) {
                throw ValidationException::withMessages([
                    'statut' => [
                        'Une commande annulée ne peut pas être réactivée automatiquement.',
                    ],
                ]);
            }

            // Restituer le stock une seule fois en cas d'annulation
            if (
                $nouveauStatut === 'annulee'
                && $commande->statut !== 'annulee'
            ) {
                $articles = $commande->articles;

                foreach ($articles as $article) {
                    $produit = Produit::whereKey(
                        $article->produit_id
                    )
                        ->lockForUpdate()
                        ->first();

                    if ($produit) {
                        $produit->increment(
                            'stock',
                            $article->quantite
                        );
                    }
                }
            }

            $commande->statut = $nouveauStatut;
            $commande->save();

            return $commande->load([
                'articles.produit',
                'utilisateur',
            ]);
        });

        return response()->json([
            'message' => 'Statut de la commande mis à jour avec succès.',
            'commande' => $commande,
        ]);
    }

    // Enregistrer une nouvelle commande client
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom_complet' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:30'],
            'ville' => ['required', 'string', 'max:255'],
            'adresse' => ['required', 'string', 'max:1000'],

            'articles' => ['required', 'array', 'min:1'],
            'articles.*.produit_id' => [
                'required',
                'integer',
                'distinct',
                'exists:produits,id',
            ],
            'articles.*.quantite' => [
                'required',
                'integer',
                'min:1',
                'max:100',
            ],
        ]);

        $validated = $validator->validate();

        $resultat = DB::transaction(function () use ($validated) {
            $sousTotal = 0;
            $articlesValides = [];

            foreach ($validated['articles'] as $article) {
                $produit = Produit::whereKey($article['produit_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($produit->statut !== 'actif') {
                    throw ValidationException::withMessages([
                        'articles' => [
                            "Le produit {$produit->nom} n'est pas disponible.",
                        ],
                    ]);
                }

                if ($produit->stock < $article['quantite']) {
                    throw ValidationException::withMessages([
                        'articles' => [
                            "Stock insuffisant pour {$produit->nom}.",
                        ],
                    ]);
                }

                $prix = (float) $produit->prix;
                $quantite = (int) $article['quantite'];

                $sousTotal += $prix * $quantite;

                $articlesValides[] = [
                    'produit' => $produit,
                    'quantite' => $quantite,
                    'prix' => $prix,
                ];
            }

            // Calcul des frais de livraison
            $ville = mb_strtolower(trim($validated['ville']));

            if ($sousTotal >= 500) {
                $fraisLivraison = 0;
            } elseif (in_array($ville, [
                'casablanca',
                'casa',
                'الدار البيضاء',
            ], true)) {
                $fraisLivraison = 20;
            } else {
                $fraisLivraison = 40;
            }

            $totalFinal = $sousTotal + $fraisLivraison;

            $commande = Commande::create([
                'utilisateur_id' => null,
                'nom_complet' => $validated['nom_complet'],
                'telephone' => $validated['telephone'],
                'ville' => $validated['ville'],
                'adresse' => $validated['adresse'],
                'prix_total' => $totalFinal,
                'statut' => 'en_attente',
                'methode_paiement' => 'paiement à la livraison',
            ]);

            foreach ($articlesValides as $article) {
                ArticleCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $article['produit']->id,
                    'variante_produit_id' => null,
                    'quantite' => $article['quantite'],
                    'prix' => $article['prix'],
                ]);

                $article['produit']->decrement(
                    'stock',
                    $article['quantite']
                );
            }

            return [
                'commande' => $commande->load('articles.produit'),
                'sous_total' => round($sousTotal, 2),
                'frais_livraison' => $fraisLivraison,
                'total_final' => round($totalFinal, 2),
            ];
        });

        return response()->json([
            'message' => 'Commande enregistrée avec succès.',
            'commande' => $resultat['commande'],
            'sous_total' => $resultat['sous_total'],
            'frais_livraison' => $resultat['frais_livraison'],
            'total_final' => $resultat['total_final'],
        ], 201);
    }
}