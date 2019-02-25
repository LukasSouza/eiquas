<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmostraAlteracaoParametro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amostra_alteracao_parametro', function (Blueprint $table) {
            $table->integer('fk_amostra')->unsigned();
            $table->integer('fk_alteracao')->unsigned();
            $table->integer('fk_parametro')->unsigned();

            $table->primary(['fk_amostra', 'fk_alteracao', 'fk_parametro'], 'amostra_alteracao_parametro_primary');
            $table->foreign(['fk_amostra', 'fk_alteracao'], 'fk_amostra_alteracao_foreign')->references(['fk_amostra', 'fk_alteracao'])->on('amostraalteracao');
            $table->foreign('fk_parametro', 'fk_amostra_alteracao_parametro_foreign')->references('id')->on('parametro');
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
        Schema::dropIfExists('amostraalteracaoparametro');
    }
}
