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
        Schema::create('manipulations', function (Blueprint $table) {
            $table->id(); // Auto-incrémenté par défaut
            $table->string('nom_de_manipulation'); // Champ nom de manipulation
            $table->boolean('system_issue')->default(false); // Champ boolean (yes/no)
            $table->boolean('system_qualified')->default(false); // Champ boolean (yes/no)
            $table->text('type_samples'); // Champ zone de texte
            $table->text('rinsing_method'); // Champ zone de texte
            $table->integer('howmany_injections'); // Champ entier
            $table->text('issue_after_manip'); // Champ zone de texte
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('manipulations');
    }
};
