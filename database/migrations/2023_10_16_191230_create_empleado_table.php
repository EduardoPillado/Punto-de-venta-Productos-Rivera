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
        Schema::create('empleado', function (Blueprint $table) {
            $table->id('pkEmpleado')->autoIncrement();
            $table->string('nombreEmpleado', 50);
            $table->string('apellidoPaterno', 50);
            $table->string('apellidoMaterno', 50)->nullable();
            $table->text('contraseña');
            $table->string('telefono')->nullable();
            $table->unsignedBigInteger('fkSucursal')->nullable();
            $table->string('tipoEmpleado', 50);
            $table->smallInteger('estatusEmpleado');

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
        Schema::dropIfExists('empleado');
    }
};
