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
        Schema::create('colonne_manipulation', function (Blueprint $table) {
            $table->id(); // Auto-incrémenté
            $table->foreignId('manipulation_id')->constrained()->onDelete('cascade'); // Clé étrangère pour manipulations
            $table->foreignId('description_colonne_id')->constrained('descriptions_colonnes')->onDelete('cascade'); // Clé étrangère pour descriptions_colonnes
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
        Schema::dropIfExists('colonne_manipulation');
    }
};
