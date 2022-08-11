<?php

namespace App\EnumTypes\Deposits;

class DepositStatus
{
    const Pending = 'pending';
    const Scheduled = 'scheduled';
    const InProgress = 'in_progress';
    const Failed = 'failed';
    const TerminalFailed = 'terminal_failed';
    const Cancelled = 'cancelled';
    const Completed = 'completed';
}
