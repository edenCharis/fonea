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
        Schema::create('details_apprentissage', function (Blueprint $table) {
            $table->id();
            $table->integer("ndaf");
            $table->integer("ndai");
            $table->string("operateur_formation");
            $table->foreignId('apprentissage_id')->constrained('apprentissage')->onDelete('cascade');
            $table->foreignId('secteur_id')->constrained('secteur')->onDelete('cascade');
            $table->foreignId('qualification_id')->constrained('qualification')->onDelete('cascade');
       
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_apprentissage');
    }
};
