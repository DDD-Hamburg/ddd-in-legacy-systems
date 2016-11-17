<?php

namespace DDDHH\ACLExample\ContextA;

/**
 * The removal of money or securities from a bank or other place of deposit.
 */
class Withdrawal
{
    /** @var float */
    private $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function amount(): float
    {
        return $this->amount;
    }
}
