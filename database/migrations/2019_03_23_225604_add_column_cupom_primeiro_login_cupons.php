<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCupomPrimeiroLoginCupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cupons', function(Blueprint $table) {
            $table->boolean('cupom_primeiro_login')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('cupons', 'cupom_primeiro_login')) {
            Schema::table('cupons', function(Blueprint $table) {
                $table->dropColumn('cupom_primeiro_login');
            });
        }
    }
}
