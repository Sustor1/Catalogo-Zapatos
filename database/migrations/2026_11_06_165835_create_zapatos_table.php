<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla `zapatos` con los campos y tipos definidos en la prueba técnica.
     */
    public function up(): void
    {
        Schema::create('zapatos', function (Blueprint $table) {
            $table->id();                              // BIGINT autoincremental, llave primaria
            $table->string('marca', 50);               // VARCHAR(50)
            $table->string('modelo', 80);              // VARCHAR(80)
            $table->string('categoria', 20);           // Deportivo, Casual, Formal o Botas
            $table->decimal('talla', 3, 1);            // DECIMAL(3,1): 22.0 a 31.0
            $table->string('color', 50);               // VARCHAR(50)
            $table->decimal('precio', 10, 2);          // DECIMAL(10,2)
            $table->integer('existencias');            // INT
            $table->text('descripcion')->nullable();   // TEXT opcional
            $table->timestamps();                      // created_at y updated_at automáticos
        });
    }

    /**
     * Revierte la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('zapatos');
    }
};
