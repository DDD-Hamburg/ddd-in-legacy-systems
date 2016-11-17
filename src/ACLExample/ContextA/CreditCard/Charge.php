<?php

namespace DDDHH\ACLExample\ContextA\CreditAccount;

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

    /**
     * @return float
     */
    public function amount(): float
    {
        return $this->amount;
    }
}
