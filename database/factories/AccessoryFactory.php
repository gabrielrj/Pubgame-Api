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
        $editions = [AccessoryEdition::SpecialEdition, AccessoryEdition::DefaultEdition];
        $modifiers = ['+1', '-5', '+10', '-4', '8', '+4', '-1', '-10', '3'];
        $edition = $editions[array_rand($editions)];
        $modifier = $modifiers[array_rand($modifiers)];
        $isFree = $edition == AccessoryEdition::SpecialEdition ? false : random_int(0, 1);

        return [
            'type_id' => AccessoryType::query()->inRandomOrder()->first()->id,
            'rarity_id' => AccessoryRarityType::query()->inRandomOrder()->first()->id,
            'name' => $this->faker->word,
            'description' => null,
            'available_for_sale' => true,
            'available_quantity' => $isFree ? null : 100,
            'is_unlimited' => $isFree,
            'skills_id' => Skill::query()->inRandomOrder()->first()->id,
            'modifier' => $modifier,
            'is_free' => $isFree,
            'edition' => $edition,
        ];
    }
}
