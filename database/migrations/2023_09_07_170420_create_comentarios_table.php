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
        Schema::create('comentarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_cafe')->unsigned()->nullable();
            $table->bigInteger('id_usuario')->unsigned()->nullable();
            $table->text('comentario')->nullable();
            $table->string('fecha_hora')->nullable();
            $table->string('estrellas')->nullable();
            $table->boolean('activo')->nullable();
            $table->timestamps();

            $table->foreign('id_cafe')->references('id')->on('cafes')->onUpdate('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentarios');
    }
};

