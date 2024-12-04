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
            // Ajoute la colonne `column_id` en tant que clé étrangère
            $table->unsignedBigInteger('column_id')->nullable();

            // Définition de la clé étrangère qui référence `id` dans la table `columns`
            $table->foreign('column_id')->references('id')->on('columns')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('manipulations', function (Blueprint $table) {
            // Suppression de la contrainte de clé étrangère et de la colonne
            $table->dropForeign(['column_id']);
            $table->dropColumn('column_id');
        });
    }
};
