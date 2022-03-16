<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxAccessoryRarityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_accessory_rarity_types', function (Blueprint $table) {
            $table->id();

            $table->string('name', 128)->index();

            $table->string('description', 256)->index();

            $table->json('probability_accessory_rarity')
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
        Schema::dropIfExists('box_accessory_rarity_types');
    }
}
