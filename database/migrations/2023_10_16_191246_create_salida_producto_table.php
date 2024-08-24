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
        Schema::create('salidaProducto', function (Blueprint $table) {
            $table->id('pkSalidaProducto')->autoIncrement();
            $table->unsignedBigInteger('fkSalida');
            $table->unsignedBigInteger('fkInventario');
            $table->integer('cantidadUnidades');
            $table->decimal('importePorProducto', 10, 2);

            $table->foreign("fkSalida")
                ->references("pkSalida")
                ->on("salida");
            
            $table->foreign("fkInventario")
                ->references("pkInventario")
                ->on("inventario");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salidaProducto');
    }
};
