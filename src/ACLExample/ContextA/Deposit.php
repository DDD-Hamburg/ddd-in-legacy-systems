<?php

namespace DDDHH\ACLExample\ContextA;

/**
 * A sum of money deposited in a bank usually at interest.
 */
class Deposit
{
    /** @var float */
    private $amount;

    /** @var bool */
    private $isCleared;

    /**
     * @param float @amount
     * @param bool $isCleared Denotes if the deposit is settled
     */
    public function __construct(float $amount, bool $isCleared)
    {
        $this->amount = $amount;
        $this->isCleared = $isCleared;
    }

    public function isCleared(): bool
    {
        return $this->isCleared;
    }

    public function amount(): float
    {
        return $this->amount;
    }
}
