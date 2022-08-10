<?php

namespace App\Models\Game;

use App\Exceptions\Api\Avatar\AccessoryDoesNotBelongToThePlayerException;
use App\Exceptions\Api\Avatar\AccessoryIsAlreadyMountedOnAnotherAvatarException;
use App\Exceptions\Api\Avatar\AccessoryLimitForMountingExceededException;
use App\Models\Game\Settings\Accessory;
use App\Models\Game\Settings\AvatarRarityType;
use App\Models\Game\Settings\CollectionPuberType;
use App\Models\Traits\HasUuidKey;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Avatar extends ProductTransactionable
{
    use HasFactory, SoftDeletes, HasUuidKey;

    protected $table = 'avatars';

    protected $fillable = [
        'players_id',
        'surname',
        'cost_type',
        'box_id',
        'color',
        'last_game_date',
        'nft_hash',
        'collection_puber_types_id',
        'avatar_rarity_types_id',
        'url_image',
    ];

    protected $hidden = [
        'id',
        'box_id',
        'players_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'last_game_date',
        'collection_puber_types_id',
        'avatar_rarity_types_id',
        'url_image',
    ];

    protected $dates = [
        'last_game_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = ['is_nft'];

    //Relationships//
    public function player(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Player::class, 'players_id', 'id');
    }

    public function accessories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AccessoryOfPlayer::class, 'avatars_id');
    }

    public function puber_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CollectionPuberType::class, 'collection_puber_types_id');
    }

    public function rarity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AvatarRarityType::class, 'avatar_rarity_types_id');
    }


    // Attributes | Accessors & Mutators //

    public function getIsNftAttribute(): bool
    {
        return isset($this->nft_hash);
    }

    // Methods //

    /**
     * Sets the avatar's rarity level according to the quantity and rarity level of accessories..
     *
     * @return void
     */
    public function setRarity() : void
    {
        $allAccessories = $this->accessories()->with(['info.type', 'info.rarity', 'info.puber_type'])->get();

        $commonAccessoriesCount = $allAccessories->where('info.type.name', '=', 'Common')->count();
        $rareAccessoriesCount = $allAccessories->where('info.type.name', '=', 'Rare')->count();
        $epicAccessoriesCount = $allAccessories->where('info.type.name', '=', 'Epic')->count();

        if($allAccessories->count() === 6){
            $isLegendary = false;
            $oldAccessoryPuberType = null;

            foreach ($allAccessories as $accessory){
                if(!$oldAccessoryPuberType)
                    $oldAccessoryPuberType = $accessory->info->puber_type->name;
                elseif($oldAccessoryPuberType == $accessory->info->puber_type->name)
                    $isLegendary = true;
                else {
                    $isLegendary = false;
                    break;
                }
            }

            if($isLegendary)
                $this->rarity()->associate(AvatarRarityType::query()->whereName('Legendary')->first());
            elseif($commonAccessoriesCount > 0 && $rareAccessoriesCount <= 3 && $epicAccessoriesCount <= 3)
                $this->rarity()->associate(AvatarRarityType::query()->whereName('Common')->first());
            elseif($rareAccessoriesCount > 3 || ($rareAccessoriesCount === 3 && $epicAccessoriesCount === 3))
                $this->rarity()->associate(AvatarRarityType::query()->whereName('Rare')->first());
            else
                $this->rarity()->associate(AvatarRarityType::query()->whereName('Epic')->first());
        }else{
            if($rareAccessoriesCount > 3)
                $this->rarity()->associate(AvatarRarityType::query()->whereName('Rare')->first());
            elseif($epicAccessoriesCount > 3)
                $this->rarity()->associate(AvatarRarityType::query()->whereName('Epic')->first());
            else
                $this->rarity()->associate(AvatarRarityType::query()->whereName('Common')->first());
        }

    }

    /**
     * @throws AccessoryLimitForMountingExceededException
     * @throws AccessoryIsAlreadyMountedOnAnotherAvatarException
     * @throws AccessoryDoesNotBelongToThePlayerException
     */
    public function dressAccessory(AccessoryOfPlayer $accessory) : bool
    {
        if($this->accessories()->count() >= 6)
            throw new AccessoryLimitForMountingExceededException();

        if($accessory->avatars_id !== null)
            throw new AccessoryIsAlreadyMountedOnAnotherAvatarException();

        if($this->players_id !== null && $accessory->players_id != $this->players_id)
            throw new AccessoryDoesNotBelongToThePlayerException();

        $accessory->avatars_id = $this->id;
        $accessory->engagement_date_in_avatar = now();

        $saved = $accessory->save();

        $this->setRarity();

        return $saved;
    }
}
