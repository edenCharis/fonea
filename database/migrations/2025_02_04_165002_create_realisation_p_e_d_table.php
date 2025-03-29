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
        Schema::create('realisation_p_e_d', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ped_id')->constrained('ped')->onDelete('cascade');
            $table->integer("npa");
            $table->integer("nbre_intra_entre");
            $table->integer("nbre_inter_entre");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisation_p_e_d');
    }
};
