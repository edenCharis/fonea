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
        Schema::create('formation_continue', function (Blueprint $table) {
            $table->id();
            $table->string("numero_identification",255)->unique();
            $table->string("intitule",255);
            $table->integer("ned");
            $table->integer("nepc");
            $table->foreignId('secteur_id')->constrained('secteur')->onDelete('cascade');
            $table->foreignId('trimestre_id')->constrained('trimestre')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation_continue');
    }
};
