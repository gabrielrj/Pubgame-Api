<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxOfPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_of_players', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('box_accessory_types_id')->constrained('box_accessory_types');

            $table->foreignId('players_id')->constrained('players');

            $table->boolean('is_open')
                ->default(false)
                ->nullable(false);

            $table->boolean('is_pending_payment')
                ->default(true)
                ->nullable(false);

            $table->foreignId('accessories_id')
                ->nullable()
                ->constrained('accessories');

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
        Schema::dropIfExists('box_of_players');
    }
}
