<?php

namespace App\Services;

use App\Models\Game\Player;
use Illuminate\Database\Eloquent\Collection;

interface FinancialManagerInterface
{
    /**
     * Function that performs the deposit of coins on the platform.
     *
     * @param Player $player
     * @param string $coinTypeOption | App/EnumTypes/Coin/CoinTypes
     * @param float $amount
     * @return void
     */
    function deposit(Player $player, string $coinTypeOption, float $amount): void;

    /**
     * Function that performs the withdrawal of coins to the player's wallet registered on the platform.
     *
     * @param Player $player
     * @param string $coinTypeOption | App/EnumTypes/Coin/CoinTypes
     * @param float $amount
     * @return void
     */
    function withdrawal(Player $player, string $coinTypeOption, float $amount): void;

    /**
     * Get all deposits of player
     *
     * @param Player $player
     * @return Collection
     */
    function getAllDepositsOfPlayer(Player $player): Collection;

    /**
     * Get all withdrawals of player
     *
     * @param Player $player
     * @return Collection
     */
    function getAllWithdrawalsOfPlayer(Player $player): Collection;
}
