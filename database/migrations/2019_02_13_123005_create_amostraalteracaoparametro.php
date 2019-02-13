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
        Schema::create('amostraalteracaoparametro', function (Blueprint $table) {
            $table->integer('IdAmostra')->unsigned();
            $table->integer('IdAltera')->unsigned();
            $table->integer('IdParam')->unsigned();
            $table->decimal('CnParametro',12,0); 
            $table->integer('NtParametro');
            $table->primary(['IdAmostra', 'IdAltera', 'IdParam']);
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
