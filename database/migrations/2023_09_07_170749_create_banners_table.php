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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_cafe')->unsigned();
            $table->text('url_imagen');
            $table->string('fecha_hora');
            $table->string('fecha_hora_inicio');
            $table->string('fecha_hora_fin');
            $table->boolean('activo');
            $table->timestamps();

            $table->foreign('id_cafe')->references('id')->on('cafes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};

