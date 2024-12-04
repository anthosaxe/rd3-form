<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('manipulations', function (Blueprint $table) {
            // Ajoute la colonne `guard_column_id` en tant que clé étrangère si elle n'existe pas déjà
            $table->unsignedBigInteger('guard_column_id')->nullable();

            // Définition de la clé étrangère pour lier `guard_column_id` à `id` dans `guard_columns`
            $table->foreign('guard_column_id')->references('id')->on('guard_columns')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('manipulations', function (Blueprint $table) {
            // Supprime la contrainte de clé étrangère et la colonne
            $table->dropForeign(['guard_column_id']);
            $table->dropColumn('guard_column_id');
        });
    }
};
