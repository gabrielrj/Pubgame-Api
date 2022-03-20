<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessoryOfPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessory_of_players', function (Blueprint $table) {
            $table->id();

            $table->foreignId('accessories_id')
                ->nullable()
                ->constrained('accessories');

            $table->uuid('uuid');

            $table->foreignId('box_id')->nullable()->constrained('box_of_players');

            $table->foreignId('players_id')->constrained('players');

            $table->foreignId('avatars_id')
                ->nullable()
                ->constrained('avatars');

            $table->dateTime('engagement_date_in_avatar')->nullable();

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
        Schema::dropIfExists('accessory_of_players');
    }
}
