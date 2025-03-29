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
        Schema::create('journal_activites', function (Blueprint $table) {
            $table->id();
            $table->String("libelle")->unique();
            $table->String("statut");
            $table->dateTime("date_enregistrement");
            $table->String("type");
            $table->foreignId("direction")->constrained('direction')->onDelete('cascade')->nullable();
            $table->foreignId("trimestre_id")->constrained('trimestre')->onDelete('cascade')->nullable();
            $table->foreignId("user_id")->constrained("users")->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_activites');
    }
};
