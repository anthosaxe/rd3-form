<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('descriptions_colonnes', function (Blueprint $table) {
            $table->id(); // Auto-incrémenté
            $table->text('identifiant'); // Champ texte
            $table->text('type'); // Champ texte
            $table->text('chimie'); // Champ texte
            $table->text('dimension'); // Champ texte
            $table->text('reference'); // Champ texte
            $table->text('rince_solvent'); // Champ texte
            $table->text('type_guard_colonne'); // Champ texte
            $table->text('chimie_guard_colonne'); // Champ texte
            $table->text('dimension_guard_colonne'); // Champ texte
            $table->text('identifiant_guard_colonne'); // Champ texte
            $table->text('reference_guard_colonne'); // Champ texte
            $table->timestamps(); // Colonnes created_at et updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('descriptions_colonnes');
    }
};
