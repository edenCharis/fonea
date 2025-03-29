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
        //
        Schema::create('details_t_d_e', function (Blueprint $table) {
            $table->id();
            $table->integer("npipi");
            $table->integer("nipi");
            $table->integer("npipaf");
            $table->integer("npipai");
            $table->integer("nipv");
            $table->string("operateur_formation");
            $table->foreignId('metier_id')->constrained('metier')->onDelete('cascade');
            $table->foreignId('secteur_id')->constrained('secteur')->onDelete('cascade');
            $table->foreignId('tde_id')->constrained('tde')->onDelete('cascade');
       
             });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('details_t_d_e');
    }
};
