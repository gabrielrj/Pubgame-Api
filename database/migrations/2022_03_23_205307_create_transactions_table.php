<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')->unique();

            $table->foreignId('players_id')->constrained('players');

            $table->string('source_wallet', 256)
                ->nullable()
                ->index();

            $table->string('destination_wallet', 256)
                ->nullable()
                ->index();

            $table->string('blockchain_hash_transaction', 256)
                ->nullable();

            $table->decimal('game_current_amount_of_coins', 16,9)
                ->nullable();

            $table->decimal('game_expected_amount_of_coins', 16,9)
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
             * App/EnumTypes/Transactions/TransactionType
             */
            $table->string('type', 50)->index();

            /**
             * App/EnumTypes/Transactions/TransactionStatus
             */
            $table->string('status', 50)
                ->default(\App\EnumTypes\Transactions\TransactionStatus::Pending)
                ->index();

            /**
             * App/EnumTypes/Transactions/TransactionOperation
             */
            $table->string('operation', 5)
                ->index();

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
        Schema::dropIfExists('transactions');
    }
}
