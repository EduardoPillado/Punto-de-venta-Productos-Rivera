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
        Schema::create('corteEmpleado', function (Blueprint $table) {
            $table->id('pkCorteEmpleado')->autoIncrement();
            $table->unsignedBigInteger('fkCorte');
            $table->unsignedBigInteger('fkEmpleado');
            $table->timestamps();

            $table->foreign('fkCorte')
                ->references('pkCorte')
                ->on('corte');

            $table->foreign('fkEmpleado')
                ->references('pkEmpleado')
                ->on('empleado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('corteEmpleado');
    }
};
