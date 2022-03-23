<?php

namespace App\EnumTypes\Transactions;

class TransactionStatus
{
    const Pending = 'pending';
    const Scheduled = 'scheduled';
    const InProgress = 'in_progress';
    const Failed = 'failed';
    const Cancelled = 'cancelled';
    const Completed = 'completed';
}
