<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLootboxItemOfPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lootbox_item_of_players', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lootbox_items_id')
                ->constrained('lootbox_items');

            $table->foreignId('lootbox_of_players_id')
                ->nullable()
                ->constrained('lootbox_of_players');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lootbox_item_of_players');
    }
}
