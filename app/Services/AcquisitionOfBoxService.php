<?php

namespace App\Services;

use App\Models\Game\Settings\BoxAccessoryType;
use App\Services\Repositories\BoxAccessoryTypeRepositoryInterface;
use App\Services\Traits\ServiceCallableIntercept;
use Exception;

abstract class AcquisitionOfBoxService implements \App\Services\AcquisitionOfBoxServiceInterface
{
    use ServiceCallableIntercept;

    /**
     * @throws Exception
     */
    public function performsWriteOffInTheInventoryOfBoxes(BoxAccessoryType $boxAccessoryType) : bool
    {
        return $this->run(function () use ($boxAccessoryType) {
            if($boxAccessoryType->is_unlimited)
                return false;

            $newQuantityForSale = $boxAccessoryType->quantity_for_sale - 1;

            $boxAccessoryTypeRepository = app()->make(BoxAccessoryTypeRepositoryInterface::class);

            return $boxAccessoryTypeRepository->update($boxAccessoryType, ['quantity_for_sale' => $newQuantityForSale]);
        }, __FUNCTION__);
    }
}
