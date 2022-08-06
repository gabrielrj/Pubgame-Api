<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionPuberTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_puber_types', function (Blueprint $table) {
            $table->id();

            $table->foreignId('accessory_collections_id')
                ->nullable()
                ->constrained('accessory_collections');

            $table->string('name', 60)->index("idx_collection_puber_types_name");

            $table->string('description', 256)->nullable();

            $table->integer('legendary_avatars_count')->nullable();

            $table->integer('epic_avatars_count')->nullable();

            $table->integer('rare_avatars_count')->nullable();

            $table->integer('common_avatars_count')->nullable();

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
        Schema::dropIfExists('collection_puber_types');
    }
}
