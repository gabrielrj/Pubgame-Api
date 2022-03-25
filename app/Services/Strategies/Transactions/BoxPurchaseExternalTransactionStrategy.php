<?php

namespace App\Services\Strategies\Transactions;

use App\EnumTypes\Transactions\TransactionStatus;
use App\EnumTypes\Transactions\TransactionType;
use App\Exceptions\Api\FeatureNotImplementedException;
use App\Models\Game\Player;
use App\Models\Game\Transaction;
use App\Services\Repositories\TransactionRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class BoxPurchaseExternalTransactionStrategy implements \App\Services\RegisterTransactionServiceInterface
{
    use ServiceCallableIntercept;

    protected TransactionRepositoryInterface $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * @throws Exception
     */
    function createNewTransaction(Player $player, array $payload = null, Model $item = null): Transaction
    {
        return $this->run(function () use ($player, $payload, $item) {
            throw_if(!Arr::exists($payload, 'hash_transaction') || !isset($payload['hash_transaction']), new \InvalidArgumentException('It is mandatory to send the hash of the value transfer transaction carried out by the Ethereum blockchain.'));

            return $this->transactionRepository->create([
                'players_id' => $player->id,
                'blockchain_hash_transaction' => $payload['hash_transaction'],
                'type' => TransactionType::ExternalBoxSales,
                'status' => TransactionStatus::Pending
            ]);
        }, __FUNCTION__);
    }
}
