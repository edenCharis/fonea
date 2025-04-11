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
        Schema::create('activites', function (Blueprint $table) {
            $table->id();
            $table->String("libelle")->unique();
            $table->String("type_compte");
            $table->double("mtb");
            $table->foreignId("direction_id")->constrained('direction')->onDelete('cascade')->nullable();
            $table->foreignId("annee_id")->constrained('annee')->onDelete('cascade')->nullable();
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activites');
    }
};
