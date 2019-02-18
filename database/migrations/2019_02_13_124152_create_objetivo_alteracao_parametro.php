<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjetivoAlteracaoParametro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objetivo_alteracao_parametro', function (Blueprint $table) {
            $table->integer('fk_objetivo')->unsigned();
            $table->integer('fk_alteracao')->unsigned();
            $table->integer('fk_parametro')->unsigned();

            $table->primary(['fk_objetivo', 'fk_alteracao', 'fk_parametro'], 'objetivo_alteracao_parametro_primary');
            $table->foreign('fk_objetivo', 'fk_objetivo_foreign')->references('id_objetivo')->on('objetivo');
            $table->foreign('fk_alteracao', 'fk_alteracao_foreign')->references('id_alteracao')->on('alteracao');
            $table->foreign('fk_parametro', 'fk_parametro_foreign')->references('id_parametro')->on('parametro');
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
        Schema::dropIfExists('objetivo_alteracao_parametro');
    }
}
