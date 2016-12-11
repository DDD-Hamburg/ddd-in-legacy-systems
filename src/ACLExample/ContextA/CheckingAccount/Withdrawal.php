<?php

namespace DDDHH\ACLExample\ContextA\CheckingAccount;

/**
 * The removal of money or securities from a bank or other place of deposit.
 */
class Withdrawal
{
    /** @var float */
    private $amount;

    /**
     * @param float $amount
     */
    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return float
     */
    public function amount(): float
    {
        return $this->amount;
    }
}
