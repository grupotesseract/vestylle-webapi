<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnFotoCaminhoCupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cupons', function(Blueprint $table) {
            $table->text('foto_caminho')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('cupons', 'foto_caminho')) {
            Schema::table('cupons', function(Blueprint $table) {
                $table->dropColumn('foto_caminho');
            });
        }
    }
}
