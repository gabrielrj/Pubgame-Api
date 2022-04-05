<?php

namespace App\Services\Strategies\AcquisitionOfBox;

use App\Services\AcquisitionOfBoxServiceInterface;

class AcquisitionOfBoxStrategy implements \App\Services\AcquisitionOfBoxServiceInterface
{
    protected AcquisitionOfBoxServiceInterface $acquisitionOfBoxService;

    public function __construct(AcquisitionOfBoxServiceInterface $acquisitionOfBoxService)
    {
        $this->acquisitionOfBoxService = $acquisitionOfBoxService;
    }
}
