<?php

namespace App\Services;

use App\Models\Game\BoxOfPlayer;
use App\Models\Game\Player;
use App\Models\Game\Settings\BoxAccessoryType;
use App\Services\Repositories\BoxOfPlayerRepositoryInterface;
use App\Services\Strategies\Transactions\BoxPurchaseExternalTransactionStrategy;
use App\Services\Strategies\Transactions\BoxPurchaseInternalTransactionStrategy;
use App\Services\Strategies\Transactions\RegisterTransactionStrategy;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Support\Facades\DB;

class BoxSalesService implements BoxSalesServiceInterface
{
    use ServiceCallableIntercept;

    protected BoxOfPlayerRepositoryInterface $boxOfPlayerRepository;
    protected RegisterTransactionServiceInterface $transactionService;

    public function __construct(BoxOfPlayerRepositoryInterface $boxOfPlayerRepository)
    {
        $this->boxOfPlayerRepository = $boxOfPlayerRepository;
    }

    /**
     * @throws Exception
     */
    function performsExternalSales(Player $player, BoxAccessoryType $boxAccessoryType, string $hashTransaction): bool
    {
        return $this->run(function () use($player, $boxAccessoryType, $hashTransaction) {
            $this->transactionService = new RegisterTransactionStrategy(app()->make(BoxPurchaseExternalTransactionStrategy::class));

            return DB::transaction(function () use($player, $boxAccessoryType, $hashTransaction) {
                $purchaseTransaction = $this->transactionService->createNewTransaction($player, ['hash_transaction' => $hashTransaction]);

                $newBox = $this->boxOfPlayerRepository->create([
                    'box_accessory_types_id' => $boxAccessoryType->id,
                    'players_id' => $player->id,
                    'is_open' => false,
                    'accessory_id' => null,
                    'is_pending_payment' => true,
                ]);

                $newBox?->transactions()->save($purchaseTransaction);
            });
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    function performsInternalSales(Player $player, BoxAccessoryType $boxAccessoryType): BoxOfPlayer
    {
        return $this->run(function () use($player, $boxAccessoryType) {
            $this->transactionService = new RegisterTransactionStrategy(app()->make(BoxPurchaseInternalTransactionStrategy::class));

            return DB::transaction(function () use ($player, $boxAccessoryType) {
                $purchaseTransaction = $this->transactionService->createNewTransaction($player, ['box_price' => $boxAccessoryType->price, 'coin_types_id' => $boxAccessoryType->price_coin_id]);

                $newBox = $this->boxOfPlayerRepository->create([
                    'box_accessory_types_id' => $boxAccessoryType->id,
                    'players_id' => $player->id,
                    'is_open' => false,
                    'accessory_id' => null,
                    'is_pending_payment' => false,
                ]);

                $newBox?->transactions()->save($purchaseTransaction);
            });
        }, __FUNCTION__);
    }
}
