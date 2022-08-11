<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('players_id')->constrained('players');

            $table->string('blockchain_hash_transaction', 256)
                ->nullable();

            $table->decimal('coin_amount', 16,9)
                ->nullable();

            $table->foreignId('coin_types_id')
                ->nullable()
                ->constrained('coin_types');

            $table->decimal('fee_amount', 16,9)
                ->default(0)
                ->nullable();

            $table->decimal('fee_percentage',5)
                ->nullable();

            /**
             * App/EnumTypes/Withdraws/WithdrawStatus
             */
            $table->string('status', 50)
                ->default(\App\EnumTypes\Withdraws\WithdrawStatus::Pending)
                ->index();

            /**
             * Last time verification was performed if the operation was already completed on the blockchain.
             */
            $table->dateTime('last_verified_operation')
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
        Schema::dropIfExists('withdrawals');
    }
}
