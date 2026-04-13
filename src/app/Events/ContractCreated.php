<?php

namespace App\Events;

use App\Models\Contract;

class ContractCreated
{
    public function __construct(public Contract $contract) {}
}
