<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnCupomPrimeiroLoginCupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('cupons', 'cupom_primeiro_login')) {
            Schema::table('cupons', function(Blueprint $table) {
                $table->dropColumn('cupom_primeiro_login');
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
        // Desnecessário recriar a coluna por causa do hasColumn usado no up()
    }
}
