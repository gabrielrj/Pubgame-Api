<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLootboxOfPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lootbox_of_players', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('lootboxes_id')->constrained('lootboxes');

            $table->foreignId('players_id')->nullable()->constrained('players');

            $table->boolean('is_open')
                ->default(false);

            $table->boolean('is_pending_payment')
                ->default(true);

            $table->enum('purchase_status', ['waiting_confirmation', 'concluded', 'cancelled', 'failed'])
                ->default('waiting_confirmation');

            $table->foreignId('lootbox_items_id')
                ->nullable()
                ->constrained('lootbox_items');

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
        Schema::dropIfExists('lootbox_of_players');
    }
}
