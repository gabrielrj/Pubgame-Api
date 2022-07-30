<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsCollectionToAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accessories', function (Blueprint $table) {
            $table->foreignId('accessory_collections_id')
                ->nullable()
                ->after('rarity_id')
                ->constrained('accessory_collections');

            $table->foreignId('collection_puber_types_id')
                ->nullable()
                ->after('accessory_collections_id')
                ->constrained('collection_puber_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accessories', function (Blueprint $table) {
            $table->dropConstrainedForeignId('accessory_collections_id');
            $table->dropConstrainedForeignId('collection_puber_types_id');
        });
    }
}
