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
            $table->integer('id_tipo_refrigerante')->unsigned();
            $table->integer('id_litragem_refrigerante')->unsigned();
            $table->string('sabor', 30);
            $table->string('marca', 30);
            $table->decimal('valor', 10,2);
            $table->integer('estoque')->unsigned();
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
