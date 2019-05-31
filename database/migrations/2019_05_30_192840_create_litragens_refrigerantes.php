<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLitragensRefrigerantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('litragens_refrigerantes', function (Blueprint $table) {
            $table->increments('id_litragem_refrigerante');
            $table->string('litragem_refrigerante', 20)->unique();
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
        Schema::dropIfExists('litragens_refrigerantes');
    }
}
