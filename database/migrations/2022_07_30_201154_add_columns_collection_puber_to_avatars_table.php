<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsCollectionPuberToAvatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('avatars', function (Blueprint $table) {
            $table->foreignId('collection_puber_types_id')
                ->nullable()
                ->after('players_id')
                ->constrained('collection_puber_types');

            $table->string('url_image', 1024)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('avatars', function (Blueprint $table) {
            $table->dropConstrainedForeignId('collection_puber_types_id');

            $table->dropColumn('url_image');
        });
    }
}
