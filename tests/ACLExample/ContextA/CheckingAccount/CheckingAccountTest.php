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
        $account = new CheckingAccount('some customer id');

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
        $account = new CheckingAccount('some customer id');

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
        $account = new CheckingAccount('some customer id');

        $account->transfer(new Transfer(10.0, true));
        $account->transfer(new Transfer(15.0, false));

        $this->assertEquals(10.0, $account->holds());
    }

    /**
     * @test
     */
    public function itShouldBelongToCustomer()
    {
        $customerId = 'some customer id';
        $account = new CheckingAccount($customerId);

        $this->assertEquals($customerId, $account->customerId());
    }
}
