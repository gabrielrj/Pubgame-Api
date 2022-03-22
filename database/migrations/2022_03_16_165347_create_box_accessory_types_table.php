<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxAccessoryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_accessory_types', function (Blueprint $table) {
            $table->id();

            $table->string('name', 128)->index();

            $table->string('description', 256)->nullable();

            $table->boolean('contains_avatar')
                ->default(false)
                ->nullable(false);

            $table->string('cost_type', 4)
                ->default(\App\EnumTypes\Box\BoxCostType::Paid)
                ->nullable(false);

            $table->decimal('price')
                ->default(0)
                ->nullable(false);

            $table->json('probability_accessory_rarity')
                ->nullable();

            $table->foreignId('price_coin_id')->constrained('coin_types');

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
        Schema::dropIfExists('box_accessory_types');
    }
}
