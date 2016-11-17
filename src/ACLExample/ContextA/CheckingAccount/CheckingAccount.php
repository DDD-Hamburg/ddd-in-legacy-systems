<?php

namespace DDDHH\ACLExample\ContextA\CheckingAccount;

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
        return $this->deposits(false) - $this->withdrawals() - $this->transfers(true);
    }

    /**
     * @return float Balance without uncleared deposits
     */
    public function availableBalance(): float
    {
        return $this->deposits(true) - $this->withdrawals() - $this->transfers(false);
    }

    /**
     * @return float
     */
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

    /**
     * @param bool $clearedOnly
     * @return float
     */
    private function deposits(bool $clearedOnly): float
    {
        $clearedDeposits = 0.0;
        $deposits = 0.0;

        foreach ($this->deposits as $deposit) {
            if ($deposit->isCleared()) {
                $clearedDeposits += $deposit->amount();
            } else {
                $deposits += $deposit->amount();
            }
        }

        if ($clearedOnly) {
            return $clearedDeposits;
        }

        return $clearedDeposits + $deposits;
    }

    /**
     * @return float
     */
    private function withdrawals(): float
    {
        $withdrawals = 0.0;
        foreach ($this->withdrawals as $withdrawal) {
            $withdrawals += $withdrawal->amount();
        }
        return $withdrawals;
    }

    /**
     * @param bool $settledOnly
     * @return float
     */
    private function transfers(bool $settledOnly): float
    {
        $settledTransfers = 0.0;
        $holdTransfers = 0.0;

        foreach ($this->transfers as $transfer) {
            if ($transfer->hold()) {
                $holdTransfers += $transfer->amount();
            } else {
                $settledTransfers += $transfer->amount();
            }
        }

        if ($settledOnly) {
            return $settledTransfers;
        }

        return $settledTransfers + $holdTransfers;
    }
}
