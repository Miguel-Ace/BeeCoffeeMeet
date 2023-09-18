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
        Schema::create('otro_cafes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_cafe')->unsigned();
            $table->text('otros_cafe');
            $table->timestamps();

            $table->foreign('id_cafe')->references('id')->on('cafes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otro_cafes');
    }
};
