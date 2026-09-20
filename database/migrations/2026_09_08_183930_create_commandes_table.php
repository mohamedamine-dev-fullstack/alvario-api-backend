<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('utilisateur_id')
              ->constrained('utilisateurs')
              ->onDelete('cascade');

            $table->string('nom_complet');
            $table->string('telephone');
            $table->string('ville');
            $table->string('adresse');
            $table->decimal('prix_total', 10, 2);
            $table->string('statut');
            $table->string('methode_paiement')->default('paiement à la livraison');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
