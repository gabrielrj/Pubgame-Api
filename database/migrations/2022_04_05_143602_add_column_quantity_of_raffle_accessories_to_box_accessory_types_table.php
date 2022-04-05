<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnQuantityOfRaffleAccessoriesToBoxAccessoryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('box_accessory_types', function (Blueprint $table) {
            $table->unsignedSmallInteger('quantity_of_raffle_accessories')
                ->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('box_accessory_types', function (Blueprint $table) {
            $table->dropColumn('quantity_of_raffle_accessories');
        });
    }
}
