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
        Schema::create('produits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('categorie_id')
              ->constrained('categories')
              ->onDelete('cascade');

            $table->string('nom');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('prix', 10, 2);
            $table->decimal('ancien_prix', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->string('statut')->default('actif');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
