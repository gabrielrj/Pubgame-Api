<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLootboxItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lootbox_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lootboxes_id')
                ->nullable()
                ->constrained('lootboxes');

            $table->string('name', 128)->index();

            $table->string('description', 256)->nullable();

            $table->boolean('available_for_sale')->default(false);

            $table->integer('quantity_made_available')->nullable();

            $table->integer('remaining_amount')->nullable();

            $table->float('probability_percentage', 5)->nullable();

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
        Schema::dropIfExists('lootbox_items');
    }
}
