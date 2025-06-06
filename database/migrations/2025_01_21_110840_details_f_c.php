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

        Schema::create('details_f_c', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formation_continue_id')->constrained('formation_continue')->onDelete('cascade');
            $table->foreignId('competence_id')->constrained('competence')->onDelete('cascade');
            $table->string("entreprise",255);
            $table->integer("nbrEmploye");
              });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('details_f_c');
    }
};
