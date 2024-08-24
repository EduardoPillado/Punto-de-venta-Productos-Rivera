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
        Schema::create('entrada', function (Blueprint $table) {
            $table->id('pkEntrada')->autoIncrement();
            $table->text('descripcionEntrada');
            $table->unsignedBigInteger('fkEmpleado');
            $table->unsignedBigInteger('fkTipoEntrada');
            $table->decimal('importeTotalEntrada', 10, 2);
            $table->unsignedBigInteger('fkSucursal');
            $table->dateTime('fechaEntrada');

            $table->foreign("fkEmpleado")
                ->references("pkEmpleado")
                ->on("empleado");

            $table->foreign("fkTipoEntrada")
                ->references("pkTipoEntrada")
                ->on("tipoEntrada");

            $table->foreign("fkSucursal")
                ->references("pkSucursal")
                ->on("sucursal");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrada');
    }
};
