<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FkRefrigerantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('refrigerantes', function (Blueprint $table) {
            $table->foreign('id_tipo_refrigerante')
                ->references('id_tipo_refrigerante')
                ->on('tipos_refrigerantes');

            $table->foreign('id_litragem_refrigerante')
                ->references('id_litragem_refrigerante')
                ->on('litragens_refrigerantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('refrigerantes', function (Blueprint $table) {
            $table->dropForeign('refrigerantes_id_tipo_refrigerante_foreign');
            $table->dropForeign('refrigerantes_id_litragem_refrigerante_foreign');
        });
    }
}
