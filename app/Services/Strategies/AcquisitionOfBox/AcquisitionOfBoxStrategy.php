<?php

namespace App\Services\Strategies\AcquisitionOfBox;

use App\Models\Game\BoxOfPlayer;
use App\Models\Game\Player;
use App\Services\AcquisitionOfBoxServiceInterface;

class AcquisitionOfBoxStrategy implements \App\Services\AcquisitionOfBoxServiceInterface
{
    protected AcquisitionOfBoxServiceInterface $acquisitionOfBoxService;

    public function __construct(AcquisitionOfBoxServiceInterface $acquisitionOfBoxService)
    {
        $this->acquisitionOfBoxService = $acquisitionOfBoxService;
    }

    function acquisitionOfBox(Player $player, array $payload)
    {
        return $this->acquisitionOfBoxService->acquisitionOfBox($player, $payload);
    }
}
