<?php

namespace App\EnumTypes\Game;

class ClaimStatus
{
    const PendingCompletionGame = 'pending_completion_game';

    const AwaitingClaim = 'awaiting_claim';

    const Claimed = 'claimed';

    const CanceledClaim = 'canceled_claim';
}
