<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePessoasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();

            $table->integer('id_vestylle')->nullable();
            $table->smallInteger('saldo_pontos')->nullable();
            $table->smallInteger('celular')->nullable();

            $table->smallInteger('telefone_fixo')->nullable();
            $table->string('nome')->nullable();
            $table->string('cpf')->nullable();
            $table->string('email')->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro')->nullable();
            $table->string('complemento')->nullable();
            $table->timestamp('data_ultima_compra')->nullable();

            $table->smallInteger('cidade_id')->nullable();
            $table->foreign('cidade_id')->references('id')->on('cidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pessoas');
    }
}
