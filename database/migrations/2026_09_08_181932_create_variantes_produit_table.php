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
        Schema::create('variantes_produit', function (Blueprint $table) {
            $table->id();

            $table->foreignId('produit_id')
              ->constrained('produits')
              ->onDelete('cascade');

            $table->string('taille')->nullable();
            $table->string('couleur')->nullable();
            $table->integer('stock')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variantes_produit');
    }
};
