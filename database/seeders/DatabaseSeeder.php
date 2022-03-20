<?php

namespace Database\Seeders;

use App\Models\Game\Settings\AccessoryRarityType;
use App\Models\Game\Settings\AccessoryType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
    }

    private function addAccessoriesRarities(){
        try {
            $rarities = [
                ['name' => 'Common', 'description' => null],
                ['name' => 'Rare', 'description' => null],
                ['name' => 'Epic', 'description' => null],
                ['name' => 'Legendary', 'description' => null],
            ];

            foreach ($rarities as $rarity){
                $rarity = (object)$rarity;

                AccessoryRarityType::query()
                    ->firstOrCreate([
                        'name' => $rarity->name
                    ], [
                        'name' => $rarity->name,
                        'description' => $rarity->description
                    ]);
            }
        }catch (\Exception $exception){
            print_r($exception->getMessage());
        }
    }

    private function addAccessoriesType(){
        try {
            $types = [
                ['name' => 'Common', 'skill' => null, 'description' => null],
                ['name' => 'Rare', 'skill' => null, 'description' => null],
                ['name' => 'Epic', 'skill' => null, 'description' => null],
                ['name' => 'Legendary', 'skill' => null, 'description' => null],
            ];

            foreach ($types as $type){
                $type = (object)$type;

                AccessoryType::query()
                    ->firstOrCreate([
                        'name' => $type->name
                    ], [
                        'name' => $type->name,
                        'description' => $type->description
                    ]);
            }
        }catch (\Exception $exception){
            print_r($exception->getMessage());
        }
    }
}
