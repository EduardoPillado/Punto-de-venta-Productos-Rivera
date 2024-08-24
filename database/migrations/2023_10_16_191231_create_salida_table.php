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
        Schema::create('salida', function (Blueprint $table) {
            $table->id('pkSalida')->autoIncrement();
            $table->text('descripcionSalida');
            $table->unsignedBigInteger('fkEmpleado');
            $table->string('nombreCliente', 50)->nullable();
            $table->string('correoCliente', 50)->nullable();
            $table->unsignedBigInteger('fkTipoSalida');
            $table->decimal('importeTotalSalida', 10, 2);
            $table->unsignedBigInteger('fkSucursal');
            $table->dateTime('fechaSalida');

            $table->foreign("fkEmpleado")
                ->references("pkEmpleado")
                ->on("empleado");

            $table->foreign("fkTipoSalida")
                ->references("pkTipoSalida")
                ->on("tipoSalida");
            
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
        Schema::dropIfExists('salida');
    }
};
