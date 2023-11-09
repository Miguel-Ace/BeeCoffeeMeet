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
        Schema::create('cafes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_usuario')->unsigned();
            $table->string('nombre');
            $table->text('descripcion_corta');
            $table->text('descripcion_larga')->nullable();;
            $table->text('url_logo');
            $table->string('eslogan')->nullable();;
            $table->string('cantidad_mesas');
            $table->string('capacidad');
            $table->string('provincia');
            $table->string('canton');
            $table->string('distrito');
            $table->string('barrio');
            $table->text('direccion');
            $table->string('longitud');
            $table->string('latitud');
            $table->string('promedio_valoracion')->nullable();
            $table->integer('max_time_reser');
            $table->timestamps();

            $table->foreign('id_usuario')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cafes');
    }
};

