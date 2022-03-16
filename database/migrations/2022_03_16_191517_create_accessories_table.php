<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('type_id')->constrained('accessory_types');

            $table->foreignId('rarity_id')->constrained('accessory_rarity_types');

            $table->string('name', 128)->index();

            $table->string('description', 256)->nullable();

            $table->string('edition', 25)
                ->default(\App\EnumTypes\Accessory\AccessoryEdition::DefaultEdition)
                ->index();

            $table->boolean('available_for_sale')
                ->default(true)
                ->nullable(false);

            $table->integer('available_quantity')
                ->nullable();

            $table->boolean('is_unlimited')
                ->default(false)
                ->nullable(false);

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
        Schema::dropIfExists('accessories');
    }
}
