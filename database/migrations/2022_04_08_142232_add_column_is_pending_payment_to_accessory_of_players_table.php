<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIsPendingPaymentToAccessoryOfPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accessory_of_players', function (Blueprint $table) {
            $table->boolean('is_pending_payment')
                ->default(true)
                ->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accessory_of_players', function (Blueprint $table) {
            $table->dropColumn('is_pending_payment');
        });
    }
}
