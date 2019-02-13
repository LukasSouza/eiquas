<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmostraAlteracao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amostraalteracao', function (Blueprint $table) {
            $table->integer('IdAmostra')->unsigned();
            $table->integer('IdAltera')->unsigned();
            $table->integer('NtAlteracao');
            $table->primary(['IdAmostra', 'IdAltera']);
            $table->foreign('IdAmostra')->references('IdAmostra')->on('amostraalteracaoparametro');
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
        Schema::dropIfExists('amostraalteracao');
    }
}
