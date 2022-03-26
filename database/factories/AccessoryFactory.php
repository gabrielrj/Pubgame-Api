<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'type_id' => AccessoryType::query()->inRandomOrder()->first()->id,
            'rarity_id' => AccessoryRarityType::query()->inRandomOrder()->first()->id,
            'name' => $this->faker->word,
            'description' => null,
            'available_for_sale' => true,
            'available_quantity' => 100,
            'is_unlimited' => false,
            'skills_id' => Skill::query()->inRandomOrder()->first()->id,
            'modifier' => random_int(1, 10),
            'is_free' => false
        ];
    }
}
