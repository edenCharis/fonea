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

        Schema::create('realisation_t_d_e', function (Blueprint $table) {
            $table->id();
            $table->integer("nipi");
            $table->foreignId('tde_id')->constrained('tde')->onDelete('cascade');
       
             });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('realisation_t_d_e');
    }
};
