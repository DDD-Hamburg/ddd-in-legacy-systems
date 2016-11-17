<?php

namespace DDDHH\ACLExample\ContextA;

class Charge
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

    public function amount(): float
    {
        return $this->amount;
    }
}
