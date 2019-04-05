<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAmostraFkUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amostra', function (Blueprint $table) {
            $table->boolean('analise_confiavel')->after('eiquas');
            $table->integer('fk_user')->unsigned()->nullable()->after('id');
            $table->foreign('fk_user', 'fk_amostra_users_foreign')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}