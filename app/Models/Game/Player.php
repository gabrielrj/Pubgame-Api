<?php

namespace App\Models\Game;

use App\Exceptions\Api\Player\Transactions\PlayerHasNoFundsException;
use App\Models\Errors\ErrorLog;
use App\Models\Game\Settings\CoinType;
use App\Models\Traits\HasUuidKey;
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

    // Methods //
    public function getFunds(string $coinType): ?float
    {
        $result = $this->coins()
            ->where('acronym', $coinType)
            ->select('amount')
            ->first(['amount']);

        return ($result && Arr::exists($result, 'pivot')) ? $result->pivot->amount : 0;
    }

    public function checkFunds(float $coinAmount, string $coinType) : bool
    {
        return (
            $this->coins()
                ->where('acronym', $coinType)
                ->wherePivot('amount', '>=', $coinAmount)
                ->lockForUpdate()
                ->count() > 0
        );
    }

    /**
     * @throws PlayerHasNoFundsException
     * @throws Throwable
     */
    public function performsDebit(float $coinAmount, string $coinType): bool
    {
        throw_unless($this->checkFunds($coinAmount, $coinType), PlayerHasNoFundsException::class);

        $currentFunds = $this->getFunds($coinType);

        $newAmount = $currentFunds - $coinAmount;

        return $this->coins()
            ->where('acronym', '=', $coinType)
            ->newPivotQuery()
            ->update(['amount' => $newAmount]) > 0;

    }

    public function performsCredit(float $coinAmount, string $coinType): bool
    {
        $coinTypeId = CoinType::query()->where('acronym', '=', $coinType)->first()->id;

        if($this->coins()->where('coin_types_id', '=', $coinTypeId)->count() > 0) {
            $this->coins()->attach($coinTypeId, ['amount' => $coinAmount]);
            return true;
        }

        $currentFunds = $this->getFunds($coinType);

        $newAmount = $currentFunds + $coinAmount;

        return $this->coins()
                ->where('acronym', '=', $coinType)
                ->newPivotQuery()
                ->update(['amount' => $newAmount]) > 0;
    }
}
