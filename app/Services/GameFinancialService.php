<?php

namespace App\Services;

use App\Exceptions\Api\FeatureNotImplementedException;
use App\Exceptions\Api\Player\Finance\Deposit\UnexpectedDepositError;
use App\Models\Game\Finance\Deposit;
use App\Models\Game\Player;
use App\Models\Game\Settings\CoinType;
use App\Services\Repositories\CoinTypeRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Illuminate\Database\Eloquent\Collection;

class GameFinancialService implements FinancialManagerInterface
{
    use ServiceCallableIntercept;

    protected DepositService $depositService;

    protected WithdrawalService $withdrawalService;

    protected CoinTypeRepositoryInterface $coinTypeRepository;

    public function __construct(DepositService $depositService,
                                WithdrawalService $withdrawalService,
                                CoinTypeRepositoryInterface $coinTypeRepository)
    {
        $this->depositService = $depositService;
        $this->withdrawalService = $withdrawalService;
        $this->coinTypeRepository = $coinTypeRepository;
    }

    /**
     * @inheritDoc
     *
     * @throws \Exception
     */
    function deposit(Player $player, string $coinTypeOption, float $amount): void
    {
        $this->run(function () use ($player, $coinTypeOption, $amount){
            throw_if(!$amount || $amount == 0, new \Exception('The amount informed for deposit must be greater than 0 (zero).'));

            throw_if($player->is_blocked, new \Exception('The player is locked on the platform.'));

            /**
             * @var CoinType $cointType
             */
            $cointType = $this->coinTypeRepository->newQuery()
                ->whereAcronym($coinTypeOption)
                ->find();

            $deposit = $this->depositService->deposit($player, $cointType, $amount);

            throw_if(!$deposit, new UnexpectedDepositError());

        }, __FUNCTION__);
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    function withdrawal(Player $player, string $coinTypeOption, float $amount): void
    {
        $this->run(function () use ($player, $coinTypeOption, $amount){
            throw new FeatureNotImplementedException();
        }, __FUNCTION__);
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    function getAllDepositsOfPlayer(Player $player): Collection
    {
        return $this->run(function () use ($player){
            return Deposit::query()->wherePlayersId($player->id)
                ->get();
        }, __FUNCTION__);
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    function getAllWithdrawalsOfPlayer(Player $player): Collection
    {
        return $this->run(function () use ($player){
            throw new FeatureNotImplementedException();
        }, __FUNCTION__);
    }
}
