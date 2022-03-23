<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvatarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avatars', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('players_id')->nullable()->constrained('players');

            $table->string('surname', 25)
                ->nullable();

            $table->string('cost_type',4);

            $table->string('color', 128)->comment('Ex: Black, Blue, Yellow, White or Red');

            $table->foreignId('box_id')->nullable()->constrained('box_of_players');

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
        Schema::dropIfExists('avatars');
    }
}
