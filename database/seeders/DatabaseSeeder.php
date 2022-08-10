<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        if(env('app_env') == 'production') {
            $this->call(ProductionSeeder::class);
            $this->call(AccessoriesCollectionFoundersSeeder::class);
            $this->call(LegendaryAvatarsCollectionFoundersSeeder::class);
            $this->call(EpicAvatarsCollectionFoundersSeeder::class);
            $this->call(RareAvatarsCollectionFoundersSeeder::class);
        }
        else
            $this->call(TestSeeder::class);
    }


}
