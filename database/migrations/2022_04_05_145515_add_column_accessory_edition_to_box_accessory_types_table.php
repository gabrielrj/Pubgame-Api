<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnAccessoryEditionToBoxAccessoryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('box_accessory_types', function (Blueprint $table) {
            $table->string('accessory_edition', 25)
                ->default(\App\EnumTypes\Accessory\AccessoryEdition::DefaultEdition)
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
        Schema::table('box_accessory_types', function (Blueprint $table) {
            $table->dropColumn('accessory_edition');
        });
    }
}
