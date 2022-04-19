<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLastGameDateToAccessoryOfPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accessory_of_players', function (Blueprint $table) {
            $table->dateTime('last_game_date')
                ->after('engagement_date_in_avatar')
                ->nullable();
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
            $table->dropColumn('last_game_date');
        });
    }
}
