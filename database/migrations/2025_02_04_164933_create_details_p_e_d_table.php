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
        Schema::create('details_p_e_d', function (Blueprint $table) {
            $table->id();
            $table->integer("nc");
            $table->integer("npd");
            $table->string("nip");
            $table->foreignId('ped_id')->constrained('ped')->onDelete('cascade');
            $table->foreignId('metier_id')->constrained('metier')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details_p_e_d');
    }
};
