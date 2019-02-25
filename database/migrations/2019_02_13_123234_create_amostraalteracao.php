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
            $table->integer('fk_amostra')->unsigned();
            $table->integer('fk_alteracao')->unsigned();
            $table->integer('nt_alteracao');

            $table->primary(['fk_amostra', 'fk_alteracao']);
            $table->foreign('fk_amostra')->references('id')->on('amostra');
            $table->foreign('fk_alteracao')->references('id')->on('alteracao');
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
