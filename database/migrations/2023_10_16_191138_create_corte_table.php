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
        Schema::create('corte', function (Blueprint $table) {
            $table->id('pkCorte')->autoIncrement();
            $table->dateTime('fechaCorteInicio');
            $table->dateTime('fechaCorteFin');
            $table->integer('cantidadVentas');
            $table->decimal('gananciaTotal', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corte');
    }
};
