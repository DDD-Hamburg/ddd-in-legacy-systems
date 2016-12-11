<?php

namespace DDDHH\ACLExample\ContextB\ChequeingAccount;

/**
 * A transaction
 */
class Transaction
{
    const CREDITED = 'credited';
    const DEBITED = 'debited';

    /** @var string */
    private $type;

    /** @var float */
    private $credit;

    /** @var float */
    private $debit;

    /**
     * @param string $type
     * @param float $credit
     * @param float $debit
     */
    public function __construct(string $type, float $credit, float $debit)
    {
        if (!in_array($type, [ self::CREDITED, self::DEBITED ])) {
            throw new \RuntimeException("Unknown type '" . $type . "' for Transaction!");
        }

        if ($type === self::CREDITED && ($debit > 0.0 || $debit < 0.0)) {
            throw new \RuntimeException("Transaction can not be of type 'credited' and have debit!");
        }

        if ($type === self::DEBITED && ($credit > 0.0 || $credit < 0.0)) {
            throw new \RuntimeException("Transaction can not be of type 'debited' and have credit!");
        }

        $this->type = $type;
        $this->credit = $credit;
        $this->debit = $debit;
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->type;
    }

    /**
     * @return float
     */
    public function credit(): float
    {
        return $this->credit;
    }

    /**
     * @return float
     */
    public function debit(): float
    {
        return $this->debit;
    }
}
