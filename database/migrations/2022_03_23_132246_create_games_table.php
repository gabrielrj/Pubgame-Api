<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('game_types_id')->constrained('game_types');

            $table->foreignId('players_id')->constrained('players');

            $table->foreignId('avatars_id')->constrained('avatars');

            $table->foreignId('pub_tables_id')->constrained('pub_tables');

            $table->unsignedSmallInteger('number_of_avatar_accessories')
                ->default(0)
                ->nullable(false);

            $table->decimal('pub_coin_fee_to_play')
                ->default(0)
                ->nullable(false);

            $table->unsignedSmallInteger('number_of_hits')
                ->default(0);

            $table->decimal('pub_coin_earned')
                ->nullable();

            $table->string('game_status', 15)
                ->default(\App\EnumTypes\Game\GameStatus::InProgress)
                ->index();

            $table->string('claim_status', 25)
                ->default(\App\EnumTypes\Game\ClaimStatus::AwaitingClaim)
                ->index();

            $table->unsignedSmallInteger('claim_fee_percentage')
                ->nullable();

            $table->decimal('pub_coin_claimed')
                ->nullable();

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
        Schema::dropIfExists('games');
    }
}
