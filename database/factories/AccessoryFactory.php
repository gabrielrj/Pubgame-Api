<?php

namespace Database\Factories;

use App\EnumTypes\Accessory\AccessoryEdition;
use App\Models\Game\Settings\Accessory;
use App\Models\Game\Settings\AccessoryRarityType;
use App\Models\Game\Settings\AccessoryType;
use App\Models\Game\Settings\Skill;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccessoryFactory extends Factory
{

    protected $model = Accessory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition(): array
    {
        $edition = array_rand([AccessoryEdition::SpecialEdition, AccessoryEdition::DefaultEdition]);

        return [
            'type_id' => AccessoryType::query()->inRandomOrder()->first()->id,
            'rarity_id' => AccessoryRarityType::query()->inRandomOrder()->first()->id,
            'name' => $this->faker->word,
            'description' => null,
            'available_for_sale' => true,
            'available_quantity' => $edition == AccessoryEdition::DefaultEdition ? 100 : null,
            'is_unlimited' => $edition == AccessoryEdition::DefaultEdition,
            'skills_id' => Skill::query()->inRandomOrder()->first()->id,
            'modifier' => array_rand(['+1', '-5', '+10', '-4', '8', '+4', '-1', '-10', '3']),
            'is_free' => random_int(0, 1),
            'edition' => $edition,
        ];
    }
}
