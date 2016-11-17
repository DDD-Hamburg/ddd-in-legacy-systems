<?php

namespace DDDHH\ACLExample\ContextA\CheckingAccount;

use PHPUnit\Framework\TestCase;

class CheckingAccountTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCalculateBalance()
    {
        $account = new CheckingAccount();

        $account->deposit(new Deposit(150.0, true));
        $account->deposit(new Deposit(50.0, false));

        $account->withdraw(new Withdrawal(70.0));

        $account->transfer(new Transfer(10.0, true));
        $account->transfer(new Transfer(15.0, false));

        $this->assertEquals(115.0, $account->balance());
    }

    /**
     * @test
     */
    public function itShouldCalculateAvailableBalance()
    {
        $account = new CheckingAccount();

        $account->deposit(new Deposit(150.0, true));
        $account->deposit(new Deposit(50.0, false));

        $account->withdraw(new Withdrawal(70.0));

        $account->transfer(new Transfer(10.0, true));
        $account->transfer(new Transfer(15.0, false));

        $this->assertEquals(55.0, $account->availableBalance());
    }

    /**
     * @test
     */
    public function itShouldCalculateHolds()
    {
        $account = new CheckingAccount();

        $account->transfer(new Transfer(10.0, true));
        $account->transfer(new Transfer(15.0, false));

        $this->assertEquals(10.0, $account->holds());
    }
}
