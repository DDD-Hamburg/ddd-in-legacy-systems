<?php

namespace DDDHH\ACLExample\ContextA;

/**
 * A banking account
 */
class CheckingAccount
{
    /** @var Deposit[] */
    private $deposits;

    /** @var Withdrawal[] */
    private $withdrawals;

    /** @var Transfer[] */
    private $transfers;

    /**
     * @param Deposit[] $deposits
     * @param Withdrawal[] $withdrawals
     * @param Transfer[] $transfers
     */
    public function __construct(array $deposits = [], array $withdrawals = [], array $transfers = [])
    {
        $this->deposits = $deposits;
        $this->withdrawals = $withdrawals;
        $this->transfers = $transfers;
    }

    /**
     * @param Deposit $deposit
     */
    public function deposit(Deposit $deposit)
    {
        $this->deposits []= $deposit;
    }

    /**
     * @param Withdrawal $withdrawal
     */
    public function withdraw(Withdrawal $withdrawal)
    {
        $this->withdrawals []= $withdrawal;
    }

    /**
     * @param Transfer $transfer
     */
    public function transfer(Transfer $transfer)
    {
        $this->transfers []= $transfer;
    }

    /**
     * @return float Balance including uncleared deposits
     */
    public function balance(): float
    {
        $deposits = 0.0;
        foreach ($this->deposits as $deposit) {
            $deposits += $deposit->amount();
        }

        $withdrawals = 0.0;
        foreach ($this->withdrawals as $withdrawal) {
            $withdrawals += $withdrawal->amount();
        }

        $completedTransfers = 0.0;
        foreach ($this->transfers as $transfer) {
            if (!$transfer->hold()) {
                $completedTransfers += $transfer->amount();
            }
        }

        return $deposits - $withdrawals - $completedTransfers;
    }

    /**
     * @return float Balance without uncleared deposits
     */
    public function availableBalance(): float
    {
        $deposits = 0.0;
        foreach ($this->deposits as $deposit) {
            if ($deposit->isCleared()) {
                $deposits += $deposit->amount();
            }
        }

        $withdrawals = 0.0;
        foreach ($this->withdrawals as $withdrawal) {
            $withdrawals += $withdrawal->amount();
        }

        $transfers = 0.0;
        foreach ($this->transfers as $transfer) {
            $transfers += $transfer->amount();
        }

        return $deposits - $withdrawals - $transfers;
    }

    public function holds(): float
    {
        $holds = 0.0;
        foreach ($this->transfers as $transfer) {
            if ($transfer->hold()) {
                $holds += $transfer->amount();
            }
        }
        return $holds;
    }
}
