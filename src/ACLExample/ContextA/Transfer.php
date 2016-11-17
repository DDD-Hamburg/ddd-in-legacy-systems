<?php

namespace DDDHH\ACLExample\ContextA;

/**
 * Transfer of money from one account to another.
 */
class Transfer
{
    /** @var float */
    private $amount;

    /** @var bool */
    private $hold;

    /**
     * @param float $amount
     * @param bool $hold
     */
    public function __construct(float $amount, bool $hold)
    {
        $this->amount = $amount;
        $this->hold = $hold;
    }

    public function hold(): bool
    {
        return $this->hold;
    }

    public function amount(): float
    {
        return $this->amount;
    }
}
