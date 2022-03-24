<?php

namespace Database\Seeders;

use App\Models\Game\Settings\AccessoryRarityType;
use App\Models\Game\Settings\AccessoryType;
use App\Models\Game\Settings\GameType;
use App\Models\Game\Settings\PubTable;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addPubTables();

        $this->addGameTypes();
    }

    private function addPubTables(){
        try {
            $pubTables = [
                ['name' => 'Beer (Cerveja)', 'description' => null,
                    'beer_poing_settings' => [
                        ['avatar_level' => 'Common', 'table_fee' => 7, 'value_per_ball' => 3.1, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 12],
                        ['avatar_level' => 'Rare', 'table_fee' => 20, 'value_per_ball' => 5.5, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 10],
                        ['avatar_level' => 'Epic', 'table_fee' => 30, 'value_per_ball' => 9.5, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 8],
                        ['avatar_level' => 'Legendary', 'table_fee' => 50, 'value_per_ball' => 20, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 0],
                    ]
                ],
                ['name' => 'Mead (Hidromel)', 'description' => null,
                    'beer_poing_settings' => [
                        ['avatar_level' => 'Common', 'table_fee' => 8, 'value_per_ball' => 3.3, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 12],
                        ['avatar_level' => 'Rare', 'table_fee' => 28, 'value_per_ball' => 6.4, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 10],
                        ['avatar_level' => 'Epic', 'table_fee' => 50, 'value_per_ball' => 10.5, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 8],
                        ['avatar_level' => 'Legendary', 'table_fee' => 55, 'value_per_ball' => 22, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 0],
                    ]
                ],
                ['name' => 'Tequila', 'description' => null,
                    'beer_poing_settings' => [
                        ['avatar_level' => 'Common', 'table_fee' => 10, 'value_per_ball' => 3.6, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 12],
                        ['avatar_level' => 'Rare', 'table_fee' => 30, 'value_per_ball' => 6.8, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 10],
                        ['avatar_level' => 'Epic', 'table_fee' => 55, 'value_per_ball' => 11.5, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 8],
                        ['avatar_level' => 'Legendary', 'table_fee' => 65, 'value_per_ball' => 25, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 0],
                    ]
                ],
                ['name' => 'Whisky', 'description' => null,
                    'beer_poing_settings' => [
                        ['avatar_level' => 'Common', 'table_fee' => 16, 'value_per_ball' => 4.2, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 12],
                        ['avatar_level' => 'Rare', 'table_fee' => 35, 'value_per_ball' => 7.6, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 10],
                        ['avatar_level' => 'Epic', 'table_fee' => 60, 'value_per_ball' => 12.5, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 8],
                        ['avatar_level' => 'Legendary', 'table_fee' => 75, 'value_per_ball' => 28, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 0],
                    ]
                ],
                ['name' => 'Distilled Drink (Cachaça)', 'description' => null,
                    'beer_poing_settings' => [
                        ['avatar_level' => 'Common', 'table_fee' => 18, 'value_per_ball' => 4.6, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 12],
                        ['avatar_level' => 'Rare', 'table_fee' => 40, 'value_per_ball' => 8.5, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 10],
                        ['avatar_level' => 'Epic', 'table_fee' => 65, 'value_per_ball' => 13.5, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 8],
                        ['avatar_level' => 'Legendary', 'table_fee' => 85, 'value_per_ball' => 32, 'max_accessories_count' => 6, 'modifier_percentage_per_accessory' => 0],
                    ]
                ],
            ];

            foreach ($pubTables as $table){
                $table = (object)$table;

                PubTable::query()
                    ->firstOrCreate([
                        'name' => $table->name
                    ], [
                        'name' => $table->name,
                        'description' => $table->description,
                        'beer_poing_settings' => $table->beer_poing_settings
                    ]);
            }
        }catch (\Exception $exception){
            print_r($exception->getMessage());
        }
    }

    private function addGameTypes(){
        try {
            $gameTypes = [
                ['name' => 'Beer Poing', 'description' => null],
            ];

            foreach ($gameTypes as $gameType){
                $gameType = (object)$gameType;

                GameType::query()
                    ->firstOrCreate([
                        'name' => $gameType->name
                    ], [
                        'name' => $gameType->name,
                        'description' => $gameType->description
                    ]);
            }
        }catch (\Exception $exception){
            print_r($exception->getMessage());
        }
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
