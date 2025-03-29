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

        Schema::create('tde', function (Blueprint $table) {
            $table->id();
            $table->string("numero_identification");
            $table->string("intitule");
            $table->foreignId('trimestre_id')->constrained('trimestre')->onDelete('cascade');
       
             });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tde');
    }
};
