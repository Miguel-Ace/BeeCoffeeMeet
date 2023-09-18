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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_cafe')->unsigned();
            $table->string('id_usuario');
            $table->string('fecha_hora');
            $table->string('fecha_hora_inicio');
            $table->string('fecha_hora_fin');
            $table->string('cantidad_personas');
            $table->string('peticion');
            $table->text('comentarios');
            $table->string('activo');
            $table->timestamps();

            $table->foreign('id_cafe')->references('id')->on('cafes')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('id_usuario')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
