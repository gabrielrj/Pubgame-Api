<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersCoinTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_coin_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId('players_id')->constrained('players');

            $table->foreignId('coin_types_id')->constrained('coin_types');

            $table->decimal('amount', 16, 9)
                ->default(0)
                ->nullable(false);

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
        Schema::dropIfExists('players_coin_types');
    }
}
