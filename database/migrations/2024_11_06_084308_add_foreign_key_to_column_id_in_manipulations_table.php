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
            // Ajoute la clé étrangère dans la colonne `column_id` pour référencer `id` dans `columns`
            $table->foreign('column_id')->references('id')->on('columns')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('manipulations', function (Blueprint $table) {
            // Supprime la clé étrangère si la migration est annulée
            $table->dropForeign(['column_id']);
        });
    }
};
