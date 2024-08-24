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
        Schema::create('inventario', function (Blueprint $table) {
            $table->id('pkInventario')->autoIncrement();
            $table->unsignedBigInteger('fkProducto');
            $table->integer('cantidadExistencias');
            $table->dateTime('fechaUltimaActualizacion');

            $table->foreign("fkProducto")
                ->references("pkProducto")
                ->on("producto");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventario');
    }
};
