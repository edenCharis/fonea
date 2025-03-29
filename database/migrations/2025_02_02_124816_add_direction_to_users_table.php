<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        Schema::table('tde', function (Blueprint $table) {
            //
            $table->foreignId('direction')->constrained('direction')->onDelete('cascade')->nullable();
         
        });
           
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('direction');
        });
    }
    
};
