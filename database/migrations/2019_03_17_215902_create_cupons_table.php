<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCuponsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oferta_id')->unsigned()->nullable();
            $table->date('data_validade');
            $table->text('texto_cupom');
            $table->integer('porcentagem_off')->nullable();
            $table->boolean('aparece_listagem')->default(true);
            $table->timestamps();
            $table->softDeletes();
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
        Schema::drop('cupons');
    }
}
