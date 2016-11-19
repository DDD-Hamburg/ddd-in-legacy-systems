<?php

namespace DDDHH\ACLExample\ContextA\CreditAccount;

/**
 * A credit account
 */
class CreditAccount
{
    /** @var string */
    private $customerId;

    /** @var float */
    private $limit;

    /** @var Charge[] */
    private $charges;

    /**
     * @param string $customerId
     * @param float $limit
     * @param array $charges
     */
    public function __construct(string $customerId, float $limit, array $charges = [])
    {
        $this->customerId = $customerId;
        $this->limit = $limit;
        $this->charges = $charges;
    }

    /**
     * @return string
     */
    public function customerId(): string
    {
        return $this->customerId;
    }

    /**
     * @return float
     */
    public function availableCredit(): float
    {
        $availableCredit = $this->limit - $this->charges();

        if ($availableCredit < 0.0) {
            return 0.0;
        }
        return $availableCredit;
    }

    /**
     * @return float
     */
    public function balance(): float
    {

        return $this->charges() * -1.0;
    }

    /**
     * @param Charge $charge
     */
    public function charge(Charge $charge)
    {
        $this->charges []= $charge;
    }

    /**
     * @return float
     */
    private function charges(): float
    {
        $charges = 0.0;
        foreach ($this->charges as $charge) {
            $charges += $charge->amount();
        }
        return $charges;
    }
}
