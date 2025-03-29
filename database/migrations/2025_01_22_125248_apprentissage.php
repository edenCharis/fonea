<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('apprentissage', function (Blueprint $table) {
            $table->id();
            $table->string("numero_identification",255)->unique();
            $table->string("intitule",255);
            $table->foreignId('trimestre_id')->constrained('trimestre')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apprentissage');
    }
};
