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
        Schema::create('channel_manipulation', function (Blueprint $table) {
            $table->id(); // Auto-incrémenté
            $table->foreignId('manipulation_id')->constrained()->onDelete('cascade'); // Clé étrangère pour manipulations
            $table->foreignId('channel_id')->constrained()->onDelete('cascade'); // Clé étrangère pour channels
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
        Schema::dropIfExists('channel_manipulation');
    }
};
