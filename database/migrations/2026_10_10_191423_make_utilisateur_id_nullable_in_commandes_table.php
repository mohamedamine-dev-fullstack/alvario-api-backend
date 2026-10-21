
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropForeign(['utilisateur_id']);
        });

        Schema::table('commandes', function (Blueprint $table) {
            $table->unsignedBigInteger('utilisateur_id')
                ->nullable()
                ->change();
        });

        Schema::table('commandes', function (Blueprint $table) {
            $table->foreign('utilisateur_id')
                ->references('id')
                ->on('utilisateurs')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropForeign(['utilisateur_id']);
        });

        Schema::table('commandes', function (Blueprint $table) {
            $table->unsignedBigInteger('utilisateur_id')
                ->nullable(false)
                ->change();
        });

        Schema::table('commandes', function (Blueprint $table) {
            $table->foreign('utilisateur_id')
                ->references('id')
                ->on('utilisateurs')
                ->cascadeOnDelete();
        });
    }
};