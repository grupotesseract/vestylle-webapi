<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDataexpiracaoCuponsPessoas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cupons_pessoas', function (Blueprint $table) {
            $table->date('data_expiracao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cupons_pessoas', function (Blueprint $table) {
            $table->dropColumn('data_expiracao');
        });
    }
}
