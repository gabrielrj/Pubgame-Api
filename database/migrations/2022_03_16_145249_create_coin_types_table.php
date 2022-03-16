<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_types', function (Blueprint $table) {
            $table->id();

            $table->string('acronym', 5)->index();

            $table->string('name', 128)->index();

            $table->boolean('is_depositable')
                ->index()
                ->default(true)
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
        Schema::dropIfExists('coin_types');
    }
}
