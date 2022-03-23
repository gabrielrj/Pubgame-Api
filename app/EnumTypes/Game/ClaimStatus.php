<?php

namespace App\EnumTypes\Game;

class ClaimStatus
{
    const AwaitingClaim = 'awaiting_claim';

    const Claimed = 'claimed';

    const CanceledClaim = 'canceled_claim';
}
