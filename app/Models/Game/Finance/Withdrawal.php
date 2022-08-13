<?php

namespace App\Models\Game\Finance;

use App\EnumTypes\Withdraws\WithdrawStatus;
use App\Models\Game\Settings\CoinType;
use App\Models\Traits\HasUuidKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Withdrawal extends Model
{
    use HasFactory, SoftDeletes, HasUuidKey;

    protected $table = 'withdrawals';

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

    protected $appends = [
        'withdrawal_status'
    ];

    //Accessors & Mutators
    public function getWithdrawalStatusAttribute() : string
    {
        return match ($this->status) {
            WithdrawStatus::Pending => 'Pending',
            WithdrawStatus::Scheduled => 'Scheduled',
            WithdrawStatus::InProgress => 'In progress',
            WithdrawStatus::Completed => 'Completed',
            WithdrawStatus::Cancelled => 'Cancelled',
            WithdrawStatus::Failed => 'Failed',
            WithdrawStatus::TerminalFailed => 'Terminal failed',
            default => 'Unexpected status',
        };
    }

    //Relationships//
    public function coin_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CoinType::class, 'price_coin_id');
    }
}
