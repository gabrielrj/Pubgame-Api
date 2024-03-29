<?php

namespace App\Models\Game;

use App\EnumTypes\Avatar\AvatarTypeOfCost;
use App\EnumTypes\Box\BoxCostType;
use App\Exceptions\Api\Player\Transactions\PlayerHasNoFundsException;
use App\Models\Errors\ErrorLog;
use App\Models\Game\Settings\CoinType;
use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Throwable;

class Player extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasUuidKey;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nickname',
        'email',
        'password',
        'wallet_address',
        'is_blocked',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
        'is_blocked',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_blocked' => 'bool'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //Relationships//

    public function errors(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(ErrorLog::class, 'usenable');
    }

    public function coins(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(CoinType::class, 'players_coin_types', 'players_id', 'coin_types_id');
    }

    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class, 'players_id');
    }

    public function boxes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BoxOfPlayer::class, 'players_id');
    }

    public function accessories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AccessoryOfPlayer::class, 'players_id');
    }

    public function avatars(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Avatar::class, 'players_id');
    }

    // Methods //
    public function getFunds(int $coinTypesId): ?float
    {
        $result = $this->coins()
            ->where('coin_types_id', $coinTypesId)
            ->select('amount')
            ->first(['amount']);

        return ($result && Arr::exists($result, 'amount')) ? $result->amount : 0;
    }

    public function checkFunds(float $coinAmount, int $coinTypesId) : bool
    {
        return (
            $this->coins()
                ->where('coin_types_id', $coinTypesId)
                ->wherePivot('amount', '>=', $coinAmount)
                ->lockForUpdate()
                ->count() > 0
        );
    }

    /**
     * @throws PlayerHasNoFundsException
     * @throws Throwable
     */
    public function performsDebit(float $coinAmount, int $coinTypesId): bool
    {
        throw_unless($this->checkFunds($coinAmount, $coinTypesId), PlayerHasNoFundsException::class);

        $currentFunds = $this->getFunds($coinTypesId);

        $newAmount = $currentFunds - $coinAmount;

        return $this->coins()
            ->where('coin_types_id', $coinTypesId)
            ->newPivotQuery()
            ->update(['amount' => $newAmount]) > 0;

    }

    public function performsCredit(float $coinAmount, int $coinTypesId): bool
    {
        if($this->coins()->where('coin_types_id', '=', $coinTypesId)->count() > 0) {
            $this->coins()->attach($coinTypesId, ['amount' => $coinAmount]);
            return true;
        }

        $currentFunds = $this->getFunds($coinTypesId);

        $newAmount = $currentFunds + $coinAmount;

        return $this->coins()
                ->where('id', $coinTypesId)
                ->newPivotQuery()
                ->update(['amount' => $newAmount]) > 0;
    }

    public function alreadyHaveFreeBoxOrAvatar() : bool
    {
        /*$haveFreeBox = $this->boxes()
                ->withTrashed()
                ->whereHas('type', function (Builder $subQuery1){
                    $subQuery1->whereCostType(BoxCostType::Free);
                })
                ->count() > 0;

        if($haveFreeBox)
            return true;*/

        return $this->avatars()
                ->whereCostType(AvatarTypeOfCost::Free)
                ->count() > 0;
    }

    public function alreadyReachedAvatarLimit(): bool
    {
        return $this->avatars()->count() >= 15;
    }
}
