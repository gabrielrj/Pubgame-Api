<?php

namespace App\Models\Game;

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
     * @return bool
     */
    public function setRarity() : bool
    {
        $accessories = $this->accessories()->with(['type', 'rarity', 'puber_type'])->get();

        if($accessories->count() < 6) {
            $this->avatar_rarity_types_id = AvatarRarityType::query()->whereName('Common')->find()->id;
            return $this->save();
        }else{
            $accessoriesForPuberTypeCount = $accessories->countBy();

            $commonAccessoriesCount = $accessories->where('type.name', '=', 'Common')->count();
            $rareAccessoriesCount = $accessories->where('type.name', '=', 'Rare')->count();
            $epicAccessoriesCount = $accessories->where('type.name', '=', 'Epic')->count();
            $legendaryAccessoriesCount = $accessories->where('type.name', '=', 'Legendary')->count();
        }

    }
}
