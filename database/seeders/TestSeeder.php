<?php

namespace Database\Seeders;

use App\EnumTypes\Box\BoxCostType;
use App\EnumTypes\Coin\CoinTypes;
use App\Models\Game\Settings\Accessory;
use App\Models\Game\Settings\AccessoryRarityType;
use App\Models\Game\Settings\AccessoryType;
use App\Models\Game\Settings\AvatarRarityType;
use App\Models\Game\Settings\BoxAccessoryType;
use App\Models\Game\Settings\CoinType;
use App\Models\Game\Settings\GameType;
use App\Models\Game\Settings\PubTable;
use App\Models\Game\Settings\Skill;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->addCoinTypes();

        $this->addPubTables();

        $this->addGameTypes();

        $this->addAvatarRarities();

        $this->addAccessoriesRarities();

        $this->addAccessoriesType();

        $this->addBoxTypes();

        $this->addSkills();

        $this->addAccessories();
    }

    private function addCoinTypes(){
        try {
            $coinTypes = [
                ['name' => 'PubBeer Coin', 'acronym' => 'PBC', 'is_depositable' => true],
                ['name' => 'Binance Coin', 'acronym' => 'BNB', 'is_depositable' => true],
                ['name' => 'Binance USD (Dólar)', 'acronym' => 'BUSD', 'is_depositable' => true],
            ];

            foreach ($coinTypes as $type){

                CoinType::query()
                    ->firstOrCreate([
                        'name' => $type['name']
                    ], $type);
            }
        }catch (\Exception $exception){
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
        }
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
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
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
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
        }
    }

    private function addAvatarRarities(){
        try {
            $avatarRarities = [
                ['name' => 'Common', 'description' => null],
                ['name' => 'Rare', 'description' => null],
                ['name' => 'Epic', 'description' => null],
                ['name' => 'Legendary', 'description' => null],
            ];

            foreach ($avatarRarities as $rarity){
                $rarity = (object)$rarity;

                AvatarRarityType::query()
                    ->firstOrCreate([
                        'name' => $rarity->name
                    ], [
                        'name' => $rarity->name,
                        'description' => $rarity->description
                    ]);
            }
        }catch (\Exception $exception){
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
        }
    }

    private function addAccessoriesRarities(){
        try {
            $accessoryRarities = [
                ['name' => 'Common', 'description' => null],
                ['name' => 'Rare', 'description' => null],
                ['name' => 'Epic', 'description' => null],
                ['name' => 'Legendary', 'description' => null],
            ];

            foreach ($accessoryRarities as $rarity){
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
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
        }
    }

    private function addAccessoriesType(){
        try {
            $types = [
                ['name' => 'Hair', 'description' => null],
                ['name' => 'Eye', 'description' => null],
                ['name' => 'Face', 'description' => null],
                ['name' => 'Shirt', 'description' => null],
                ['name' => 'Pants', 'description' => null],
                ['name' => 'Shoe', 'description' => null],
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
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
        }
    }

    private function addBoxTypes(){
        try {
            $commonRarityId = AccessoryRarityType::query()->where('name', '=', 'Common')
                ->first()
                ->id;

            $rareRarityId = AccessoryRarityType::query()->where('name', '=', 'Rare')
                ->first()
                ->id;

            $epicRarityId = AccessoryRarityType::query()->where('name', '=', 'Epic')
                ->first()
                ->id;

            $legendaryRarityId = AccessoryRarityType::query()->where('name', '=', 'Legendary')
                ->first()
                ->id;

            $boxTypes = [
                ['name' => 'Kit Avatar Box 1', 'cost_type' => BoxCostType::Paid,
                    'contains_avatar' => true,
                    'price' => 200,
                    'price_coin_id' => CoinType::query()->where('acronym', CoinTypes::BinanceUSD)->first()->id,
                    'is_unlimited' => false,
                    'available_for_sale' => true,
                    'quantity_for_sale' => 1000,
                    'probability_accessory_rarity' => [
                        ['rarity' => $commonRarityId, 'chances' => 95],
                        ['rarity' => $rareRarityId, 'chances' => 5],
                        ['rarity' => $epicRarityId, 'chances' => 0],
                        ['rarity' => $legendaryRarityId, 'chances' => 0],
                    ],
                ],

                ['name' => 'Kit Avatar Box 2', 'cost_type' => BoxCostType::Paid,
                    'contains_avatar' => true,
                    'price' => 200,
                    'price_coin_id' => CoinType::query()->where('acronym', CoinTypes::BinanceUSD)->first()->id,
                    'is_unlimited' => false,
                    'available_for_sale' => true,
                    'quantity_for_sale' => 500,
                    'probability_accessory_rarity' => [
                        ['rarity' => $commonRarityId, 'chances' => 30],
                        ['rarity' => $rareRarityId, 'chances' => 70],
                        ['rarity' => $epicRarityId, 'chances' => 0],
                        ['rarity' => $legendaryRarityId, 'chances' => 0],
                    ],
                ],

                ['name' => 'Kit Avatar Box 3', 'cost_type' => BoxCostType::Paid,
                    'contains_avatar' => true,
                    'price' => 200,
                    'price_coin_id' => CoinType::query()->where('acronym', CoinTypes::BinanceUSD)->first()->id,
                    'is_unlimited' => true,
                    'available_for_sale' => true,
                    'quantity_for_sale' => 300,
                    'probability_accessory_rarity' => [
                        ['rarity' => $commonRarityId, 'chances' => 0],
                        ['rarity' => $rareRarityId, 'chances' => 50],
                        ['rarity' => $epicRarityId, 'chances' => 50],
                        ['rarity' => $legendaryRarityId, 'chances' => 0],
                    ],
                ],

                ['name' => 'Kit Free Avatar Box', 'cost_type' => BoxCostType::Free,
                    'contains_avatar' => true,
                    'is_unlimited' => true,
                    'available_for_sale' => true,
                    'quantity_for_sale' => null,
                    'quantity_of_raffle_accessories' => 2
                ],

                ['name' => 'Accessories Box 1', 'cost_type' => BoxCostType::Paid,
                    'contains_avatar' => false,
                    'price' => 200,
                    'price_coin_id' => CoinType::query()->where('acronym', CoinTypes::BinanceUSD)->first()->id,
                    'is_unlimited' => false,
                    'available_for_sale' => true,
                    'quantity_for_sale' => 1000,
                    'probability_accessory_rarity' => [
                        ['rarity' => $commonRarityId, 'chances' => 95],
                        ['rarity' => $rareRarityId, 'chances' => 5],
                        ['rarity' => $epicRarityId, 'chances' => 0],
                        ['rarity' => $legendaryRarityId, 'chances' => 0],
                    ],
                ],

                ['name' => 'Accessories Box 2', 'cost_type' => BoxCostType::Paid,
                    'contains_avatar' => false,
                    'price' => 200,
                    'price_coin_id' => CoinType::query()->where('acronym', CoinTypes::BinanceUSD)->first()->id,
                    'is_unlimited' => false,
                    'available_for_sale' => true,
                    'quantity_for_sale' => 500,
                    'probability_accessory_rarity' => [
                        ['rarity' => $commonRarityId, 'chances' => 30],
                        ['rarity' => $rareRarityId, 'chances' => 70],
                        ['rarity' => $epicRarityId, 'chances' => 0],
                        ['rarity' => $legendaryRarityId, 'chances' => 0],
                    ],
                ],

                ['name' => 'Accessories Box 3', 'cost_type' => BoxCostType::Paid,
                    'contains_avatar' => false,
                    'price' => 200,
                    'price_coin_id' => CoinType::query()->where('acronym', CoinTypes::BinanceUSD)->first()->id,
                    'is_unlimited' => true,
                    'available_for_sale' => true,
                    'quantity_for_sale' => 300,
                    'probability_accessory_rarity' => [
                        ['rarity' => $commonRarityId, 'chances' => 0],
                        ['rarity' => $rareRarityId, 'chances' => 50],
                        ['rarity' => $epicRarityId, 'chances' => 50],
                        ['rarity' => $legendaryRarityId, 'chances' => 0],
                    ],
                ],
            ];

            foreach ($boxTypes as $type){

                BoxAccessoryType::query()
                    ->firstOrCreate([
                        'name' => $type['name']
                    ], $type);
            }
        }catch (\Exception $exception){
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
        }
    }

    private function addSkills(){
        try {
            $skills = [
                ['name' => 'Reverse the force', 'code' => 'SKILL1'],
                ['name' => 'Reverse direction', 'code' => 'SKILL2'],
                ['name' => 'Don"t see the steering bar', 'code' => 'SKILL3'],
                ['name' => 'Strength speed', 'code' => 'SKILL4'],
                ['name' => 'Direction speed', 'code' => 'SKILL5'],
                ['name' => 'Blur vision', 'code' => 'SKILL6'],
            ];

            foreach ($skills as $type){

                Skill::query()
                    ->firstOrCreate([
                        'name' => $type['name']
                    ], $type);
            }
        }catch (\Exception $exception){
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
        }
    }

    private function addAccessories(){
        try {
            if(Accessory::query()->count() == 0){
                Accessory::factory(100)->create();
            }
        }catch (\Exception $exception){
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
        }
    }
}
