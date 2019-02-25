<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriaParametro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_parametro', function (Blueprint $table) {
            $table->integer('fk_categoria')->unsigned();
            $table->integer('fk_parametro')->unsigned();
            $table->decimal('concentracao_superior',12,2);

            $table->primary(['fk_categoria', 'fk_parametro']);
            $table->foreign('fk_categoria')->references('id')->on('categoria');
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
        Schema::dropIfExists('categoria_parametro');
    }
}
