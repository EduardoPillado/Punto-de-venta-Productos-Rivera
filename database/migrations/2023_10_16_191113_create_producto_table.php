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
        Schema::create('producto', function (Blueprint $table) {
            $table->id('pkProducto')->autoIncrement();
            $table->string('nombreProducto', 50);
            $table->text('descripcion')->nullable();
            $table->text('imagenProducto');
            $table->decimal('peso', 10, 2);
            $table->decimal('precio', 10, 2);
            $table->smallInteger('estatusProducto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto');
    }
};
