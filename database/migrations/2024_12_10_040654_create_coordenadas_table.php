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
        Schema::create('coordenadas', function (Blueprint $table) {
            $table->id();
            $table->integer('fila');
            $table->integer('columna');
            $table->string('celda');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordenadas');
    }
};
