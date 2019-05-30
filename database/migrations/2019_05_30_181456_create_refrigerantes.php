<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefrigerantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refrigerantes', function (Blueprint $table) {
            $table->increments('id_refrigerante');
            $table->string('id_tipo_refrigerante');
            $table->string('id_litragem_refrigerante');
            $table->string('sabor');
            $table->string('marca');
            $table->string('valor');
            $table->string('estoque');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refrigerantes');
    }
}
