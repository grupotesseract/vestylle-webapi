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
            $table->integer('id_vestylle')->nullable();

            $table->smallInteger('saldo_pontos')->nullable();

            $table->string('celular')->nullable();
            $table->string('telefone_fixo')->nullable();

            $table->string('email')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();

            $table->string('nome')->nullable();
            $table->string('cpf')->nullable()->unique();

            $table->string('cep')->nullable();
            $table->string('endereco')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('complemento')->nullable();

            $table->timestamp('data_ultima_compra')->nullable();
            $table->timestamp('data_nascimento')->nullable();

            $table->smallInteger('cidade_id')->nullable();
            $table->foreign('cidade_id')->references('id')->on('cidades');

            $table->timestamps();
            $table->softDeletes();

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
