<?php

namespace App\Services;

use App\Models\Game\Settings\Accessory;
use App\Models\Game\Settings\BoxAccessoryType;
use App\Services\Repositories\AccessoryRarityTypeRepository;
use App\Services\Repositories\AccessoryRepositoryInterface;
use App\Services\Repositories\AccessoryTypeRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Illuminate\Database\Eloquent\Model;

class AccessoryRafflebyBoxService implements AccessoryRafflebyBoxServiceInterface
{
    use ServiceCallableIntercept;

    protected AccessoryRarityTypeRepository $artRepository;
    protected AccessoryTypeRepositoryInterface $atRepository;
    protected AccessoryRepositoryInterface $aRepository;

    public function __construct(AccessoryRarityTypeRepository $artRepository,
                                AccessoryTypeRepositoryInterface $atRepository,
                                AccessoryRepositoryInterface $aRepository)
    {
        $this->artRepository = $artRepository;
        $this->atRepository = $atRepository;
        $this->aRepository = $aRepository;
    }

    public function returnsDrawnAccessory(Model|BoxAccessoryType $item): Accessory
    {
        // TODO: Implement returnsDrawnAccessory() method.
    }
}
