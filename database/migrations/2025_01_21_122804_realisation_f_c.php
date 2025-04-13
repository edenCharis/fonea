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
        Schema::create('realisation_f_c', function (Blueprint $table) {
            $table->id();
            $table->integer("ned");
            $table->integer("nepc");
            $table->string("entreprise");
            $table->foreignId('formation_continue_id')->constrained('formation_continue')->onDelete('cascade');
             });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('realisation_f_c');
    }
};
