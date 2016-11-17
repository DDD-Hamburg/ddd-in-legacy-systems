<?php

namespace DDDHH\ACLExample\ContextA;

use PHPUnit\Framework\TestCase;

class CreditAccountTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCalculateAvailableCredit()
    {
        $limit = 2000.0;
        $account = new CreditAccount($limit);

        $account->charge(new Charge(500.0));
        $account->charge(new Charge(300.0));

        $this->assertEquals(1200.0, $account->availableCredit());
    }

    /**
     * @test
     */
    public function itShouldReturnZeroForAvailableCreditIfChargesAreAboveLimit()
    {
        $limit = 2000.0;
        $account = new CreditAccount($limit);

        $account->charge(new Charge(1500.0));
        $account->charge(new Charge(600.0));

        $this->assertEquals(0.0, $account->availableCredit());
    }

    /**
     * @test
     */
    public function itShouldReturnBalance()
    {
        $limit = 2000.0;
        $account = new CreditAccount($limit);

        $account->charge(new Charge(1500.0));
        $account->charge(new Charge(400.0));

        $this->assertEquals(-1900.0, $account->balance());
    }
}
