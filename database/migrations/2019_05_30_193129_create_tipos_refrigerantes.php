<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposRefrigerantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipos_refrigerantes', function (Blueprint $table) {
            $table->increments('id_tipo_refrigerante')->unique();
            $table->string('tipo_refrigerante', 20);
            $table->boolean('flg_ativo')->default(true);
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
        Schema::dropIfExists('tipos_refrigerantes');
    }
}
