<?php

namespace App\Http\Controllers\Api\Game\Player\Deposits;

use App\EnumTypes\Coin\CoinTypes;
use App\Http\Controllers\Api\Game\Traits\GameControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Game\Player\Finance\Deposit\BUSDDepositHistoryResource;
use App\Models\Game\Player;
use App\Services\FinancialManagerInterface;
use Illuminate\Http\Request;

class BUSDDepositController extends Controller
{
    use GameControllerCallableIntercept;

    protected FinancialManagerInterface $financialManager;

    public function __construct(FinancialManagerInterface $financialManager)
    {
        $this->financialManager = $financialManager;
    }

    public function deposit(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'Player registers BUSD deposit';

        return $this->run(function () use ($request){
            /**
             * @var Player $player
             */
            $player = $request->user();

            $amount = $request->get('busdDepositAmount');

            $this->financialManager->deposit($player, CoinTypes::BinanceUSD, $amount);

            return [
                'deposit_request_success' => true
            ];
        });
    }

    public function getAllDepositsForPlayer(): \Illuminate\Http\JsonResponse
    {
        return $this->run(function () {
            /**
             * @var Player $player
             */
            $player = auth()->user();

            $deposits = $this->financialManager->getAllDepositsOfPlayer($player);

            return [
                'deposits' => BUSDDepositHistoryResource::collection($deposits)
            ];
        });
    }
}
