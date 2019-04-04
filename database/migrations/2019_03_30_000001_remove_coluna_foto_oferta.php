<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColunaFotoOferta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('ofertas', 'foto_oferta')) {
            Schema::table('ofertas', function(Blueprint $table) {
                $table->dropColumn('foto_oferta');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Se nao tiver a coluna
        if (!Schema::hasColumn('ofertas', 'foto_oferta')) {
            Schema::table('ofertas', function(Blueprint $table) {
                $table->string('foto_oferta');
            });
        }
    }
}
