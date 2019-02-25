<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtividadeParametroMin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividade_parametro_min', function (Blueprint $table) {
            $table->integer('fk_atividade')->unsigned();
            $table->integer('fk_parametro')->unsigned();

            $table->primary(['fk_atividade', 'fk_parametro']);
            $table->foreign('fk_atividade')->references('id')->on('atividade_preponderante');
            $table->foreign('fk_parametro')->references('id')->on('parametro');
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
        Schema::dropIfExists('atividade_parametro_min');
    }
}
