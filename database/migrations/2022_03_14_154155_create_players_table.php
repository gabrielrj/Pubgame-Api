<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')
                ->unique();

            $table->string('wallet_address')
                ->nullable()
                ->index('idx_wallet_address_players');

            $table->string('name')->nullable();

            $table->string('email')
                ->unique()
                ->nullable();

            $table->timestamp('email_verified_at')
                ->nullable();

            $table->string('password')
                ->nullable();

            $table->boolean('is_blocked')
                ->default(false)
                ->nullable(false);

            $table->rememberToken();

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
        Schema::dropIfExists('players');
    }
}
