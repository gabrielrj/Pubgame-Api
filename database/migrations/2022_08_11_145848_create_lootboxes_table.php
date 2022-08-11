<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLootboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lootboxes', function (Blueprint $table) {
            $table->id();

            $table->string('name', 128)->index();

            $table->string('description', 256)->nullable();

            $table->boolean('available_for_sale')->default(false);

            $table->dateTime('start_of_availability')->nullable();

            $table->dateTime('end_of_availability')->nullable();

            $table->integer('quantity_made_available')->nullable();

            $table->integer('remaining_amount')->nullable();

            $table->decimal('price')
                ->default(0)
                ->nullable(false);

            $table->foreignId('price_coin_id')
                ->nullable()
                ->constrained('coin_types');

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
        Schema::dropIfExists('lootboxes');
    }
}
