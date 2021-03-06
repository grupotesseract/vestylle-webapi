<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCampanhasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campanhas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('texto');
            $table->string('genero')->nullable();

            $table->timestamp('data_ultima_compra_menor')->nullable();
            $table->timestamp('data_ultima_compra_maior')->nullable();

            $table->timestamp('data_vencimento_pontos_menor')->nullable();
            $table->timestamp('data_vencimento_pontos_maior')->nullable();

            $table->timestamp('data_nascimento_menor')->nullable();
            $table->timestamp('data_nascimento_maior')->nullable();

            $table->smallInteger('mes_aniversario')->nullable();
            $table->string('condicao_mes_aniversario')->nullable();

            $table->smallInteger('dia_aniversario')->nullable();
            $table->string('condicao_dia_aniversario')->nullable();

            $table->integer('saldo_pontos')->nullable();
            $table->string('condicao_saldo_pontos')->nullable();

            $table->timestamps();

            $table->integer('cupon_id')->nullable();
            $table->foreign('cupon_id')->references('id')->on('cupons');
            $table->integer('oferta_id')->nullable();
            $table->foreign('oferta_id')->references('id')->on('ofertas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('campanhas');
    }
}
