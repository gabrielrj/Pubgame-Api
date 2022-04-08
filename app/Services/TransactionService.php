<?php

namespace App\Services;

use App\EnumTypes\Transactions\TransactionOperation;
use App\EnumTypes\Transactions\TransactionStatus;
//use App\EnumTypes\Transactions\TransactionType;
use App\Exceptions\Api\Player\PlayerCoinCreditException;
use App\Exceptions\Api\Player\PlayerCoinDebitException;
use App\Exceptions\Api\Player\Transactions\PlayerHasNoFundsException;
use App\Exceptions\Api\UnexpectedErrorException;
use App\Models\Game\Player;
use App\Models\Game\ProductTransactionable;
use App\Models\Game\Transaction;
use App\Models\Game\TransactionItem;
//use App\Services\Repositories\TransactionItemRepositoryInterface;
use App\Services\Repositories\TransactionRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;

abstract class TransactionService implements RegisterTransactionServiceInterface
{
    use ServiceCallableIntercept;

    /**
     * @throws Exception
     */
    protected function registerNewTransactionToPlayer(Player                 $player,
                                                      string                 $operation,
                                                      string                 $type,
                                                      string                 $status = TransactionStatus::Pending,
                                                      float                  $amount = null,
                                                      int                    $coinTypeId = null,
                                                      string                 $blockchain_hash_transaction = null,
                                                      ProductTransactionable ...$productItems) : Transaction
    {
        return $this->run(function () use($player, $amount, $coinTypeId, $operation, $type, $status, $blockchain_hash_transaction, $productItems){
            $currentFundsOfPlayer = $player->getFunds($coinTypeId);
            $gameExpectedAmountOfCoins = $currentFundsOfPlayer;

            if($operation == TransactionOperation::Debit){
                $gameExpectedAmountOfCoins = $gameExpectedAmountOfCoins - $amount;

                throw_unless($player->checkFunds($amount, $coinTypeId), PlayerHasNoFundsException::class);

                if(!$player->performsDebit($amount, $coinTypeId))
                    throw new PlayerCoinDebitException();
            }else{
                $gameExpectedAmountOfCoins = $gameExpectedAmountOfCoins + $amount;

                if(!$player->performsCredit($amount, $coinTypeId))
                    throw new PlayerCoinCreditException();
            }

            $transactionRepository = app()->make(TransactionRepositoryInterface::class);

            $newTransaction = $transactionRepository->create([
                'players_id' => $player->id,
                'game_current_amount_of_coins' => $currentFundsOfPlayer,
                'game_expected_amount_of_coins' => $gameExpectedAmountOfCoins,
                'operation' => $operation,
                'coin_amount' => $amount,
                'coin_types_id' => $coinTypeId,
                'type' => $type,
                'status' => $status,
                'blockchain_hash_transaction' => $blockchain_hash_transaction,
            ]);

            if(!$this->addItensToTransaction($newTransaction, ...$productItems))
                throw new UnexpectedErrorException();

            return $newTransaction;
        }, __FUNCTION__);
    }

    /**
     * @throws Exception
     */
    private function addItensToTransaction(Transaction $transaction, ProductTransactionable ...$productItems) : bool
    {
        return $this->run(function () use ($transaction, $productItems){
            //$transactionItemRepository = app()->make(TransactionItemRepositoryInterface::class);

            foreach ($productItems as $productItem){
                $transactionItem = new TransactionItem();
                $transactionItem->transactions_id = $transaction->id;

                $productItem->transaction_item()->save($transactionItem);
            }

            return true;
        }, __FUNCTION__);
    }
}
