<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmostra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amostra', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_atividade_preponderante');
            $table->string('descricao',45);
            $table->string('ponto_coleta',45);
            $table->date('data_coleta');
            $table->string('condicao_tempo',45);
            $table->string('numero_amostra',45)->unique();
            $table->integer('eiquas')->nullable();
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
        Schema::dropIfExists('amostra');
    }
}
