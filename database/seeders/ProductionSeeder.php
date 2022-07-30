<?php

namespace Database\Seeders;

use App\EnumTypes\Accessory\AccessoryEdition;
use App\Models\Game\Settings\Accessory;
use App\Models\Game\Settings\AccessoryCollection;
use App\Models\Game\Settings\AccessoryRarityType;
use App\Models\Game\Settings\AccessoryType;
use App\Models\Game\Settings\CollectionPuberType;
use App\Models\Game\Settings\GameType;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        DB::beginTransaction();

        try {
            $this->addAccessoriesRarities();

            $this->addAccessoriesType();

            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();

            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
    private function addAccessoryCollections(){
        try {
            $accessoryCollections = [
                ['name' => 'Founders', 'description' => null],
            ];

            foreach ($accessoryCollections as $accessoryCollection){
                $accessoryCollection = (object)$accessoryCollection;

                AccessoryCollection::query()
                    ->firstOrCreate([
                        'name' => $accessoryCollection->name
                    ], [
                        'name' => $accessoryCollection->name,
                        'description' => $accessoryCollection->description
                    ]);
            }
        }catch (Exception $exception){
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
    private function addAccessoryCollectionPuberTypes(){
        try {
            $puberTypes = [
                ['name' => 'Bad Biker', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Rapper', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Nerd', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Mad Scientist', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Cowboy', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Swimmer', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Wizard', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Pirate', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Mobster', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Detective', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Disguised', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Mushroom', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Waiter', 'collection' => 'Founders', 'description' => null],
                ['name' => 'Robot', 'collection' => 'Founders', 'description' => null],
                ['name' => 'King', 'collection' => 'Founders', 'description' => null],
            ];

            foreach ($puberTypes as $puberType){
                $puberType = (object)$puberType;

                CollectionPuberType::query()
                    ->firstOrCreate([
                        'name' => $puberType->name
                    ], [
                        'name' => $puberType->name,
                        'description' => $puberType->description,
                        'accessory_collections_id' => AccessoryCollection::query()->whereName($puberType->collection)->first()->id
                    ]);
            }
        }catch (Exception $exception){
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
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
        }catch (Exception $exception){
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
    private function addAccessoriesType(){
        try {
            $types = [
                ['name' => 'Head', 'description' => null],
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
        }catch (Exception $exception){
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
    private function addUnlimitedAccessories(){
        try {
            $accessories = [
                []
            ];

            foreach ($accessories as $accessory){
                $accessory = (object)$accessory;

                Accessory::query()
                    ->firstOrCreate([
                        'name' => $accessory->name
                    ], [
                        'name' => $accessory->name,
                        'description' => $accessory->description
                    ]);
            }
        }catch (Exception $exception){
            print_r(__FUNCTION__ . PHP_EOL);
            print_r($exception->getMessage() . PHP_EOL);
            throw $exception;
        }
    }


}
