<?php

namespace App\EnumTypes\Withdraws;

class WithdrawStatus
{
    const Pending = 'pending';
    const Scheduled = 'scheduled';
    const InProgress = 'in_progress';
    const Failed = 'failed';
    const TerminalFailed = 'terminal_failed';
    const Cancelled = 'cancelled';
    const Completed = 'completed';
}
