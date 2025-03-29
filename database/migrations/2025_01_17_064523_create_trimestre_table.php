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
        Schema::create('trimestre', function (Blueprint $table) {
            $table->id();
            $table->string('libelle', 50); // Trimester name (e.g., "Trimester 1")
            $table->foreignId('annee_id')->constrained('annee')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trimestre');
    }
};
