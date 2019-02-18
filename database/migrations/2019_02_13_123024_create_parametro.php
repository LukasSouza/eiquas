<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParametro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametro', function (Blueprint $table) {
            $table->increments('id_parametro');
            $table->string('descricao',45);
            $table->string('unidade_medida',10);
            $table->string('numero_registro_cas',15); //Chemical Abstracts Service (CAS)
            $table->string('limite_conama',10); //'Limite máximo de concentraÃ§Ã£o do parâmetro ou substância, de acordo com a ResoluÃ§Ã£o CONAMA1
            $table->string('limite_oms',45); //Limite máximo de concentração do parâmetro ou substância, de acordo com as diretrizes recomendadas pela OMS
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
        Schema::dropIfExists('parametro');
    }
}
