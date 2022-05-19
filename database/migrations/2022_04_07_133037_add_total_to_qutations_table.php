<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalToQutationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qutations', function (Blueprint $table) {
            //
            $table->float('sub_total')->nullable();
            $table->float('total')->nullable();
            $table->float('installation_fees')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qutations', function (Blueprint $table) {
            //
            $table->dropColumn('sub_total');
            $table->dropColumn('total');
            $table->dropColumn('installation_fees');
        });
    }
}
