<?php

namespace App\Models\Game;

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
        'url_image',
    ];

    protected $dates = [
        'last_game_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = ['level', 'is_nft'];

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


    //Attributes//

    public function getIsNftAttribute(): bool
    {
        return isset($this->nft_hash);
    }

    /**
     * @throws Exception
     */
    public function getLevelAttribute(): string
    {
        /*$accessoriesRarityCount = DB::table('accessory_rarity_types')
            ->join('accessories', 'accessories.rarity_id', '=', 'accessory_rarity_types.id')
            ->join('accessory_of_players', 'accessory_of_players.accessories_id', '=', 'accessories.id')
            ->whereRaw(DB::raw("accessory_of_players.avatars_id = $this->id"))
            ->selectRaw(DB::raw("distinct accessory_rarity_types.name rarity, count(accessory_of_players.accessories_id) count_of_accessories"))
            ->get();*/

        return 'Common';
    }

}
