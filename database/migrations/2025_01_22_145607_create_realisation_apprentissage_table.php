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
         Schema::create('realisation_apprentissage', function (Blueprint $table) {
            $table->id();
            $table->integer("ndf");
            $table->integer("ndi");
            $table->integer("decrochage");
            $table->foreignId('apprentissage_id')->constrained('apprentissage')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisation_apprentissage');
    }
};
