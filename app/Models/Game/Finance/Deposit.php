<?php

namespace App\Models\Game\Finance;

use App\EnumTypes\Deposits\DepositStatus;
use App\Models\Game\Settings\CoinType;
use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposit extends Model
{
    use HasFactory, SoftDeletes, HasUuidKey;

    protected $table = 'deposits';

    protected $fillable = [
        'players_id',
        'blockchain_hash_transaction',
        'coin_amount',
        'coin_types_id',
        'fee_amount',
        'fee_percentage',
        'status',
        'last_verified_operation'
    ];

    protected $hidden = [
        'players_id',
        'coin_types_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $appends = [
        'deposit_status'
    ];

    //Accessors & Mutators
    public function getDepositStatusAttribute() : string
    {
        return match ($this->status) {
            DepositStatus::Pending => 'Pending',
            DepositStatus::Scheduled => 'Scheduled',
            DepositStatus::InProgress => 'In progress',
            DepositStatus::Completed => 'Completed',
            DepositStatus::Cancelled => 'Cancelled',
            DepositStatus::Failed => 'Failed',
            DepositStatus::TerminalFailed => 'Terminal failed',
            default => 'Unexpected status',
        };
    }

    //Relationships//
    public function coin_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CoinType::class, 'price_coin_id');
    }
}
