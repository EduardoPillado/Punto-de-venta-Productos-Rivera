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
        Schema::create('entradaProducto', function (Blueprint $table) {
            $table->id('pkEntradaProducto')->autoIncrement();
            $table->unsignedBigInteger('fkEntrada');
            $table->unsignedBigInteger('fkProducto');
            $table->integer('cantidadUnidades');
            $table->decimal('importePorProducto', 10, 2);

            $table->foreign("fkEntrada")
                ->references("pkEntrada")
                ->on("entrada");
            
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
        Schema::dropIfExists('entradaProducto');
    }
};
