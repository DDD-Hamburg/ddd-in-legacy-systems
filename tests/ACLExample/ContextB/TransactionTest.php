<?php

namespace DDDHH\ACLExample\ContextB\ChequeingAccount;


use PHPUnit\Framework\TestCase;

class TransactionTest extends TestCase
{
    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Transaction can not be of type 'credited' and have debit
     */
    public function itShouldThrowExceptionForCreditedTypeWithDebitGreaterThanZero()
    {
        new Transaction(Transaction::CREDITED, 0.0, 0.1);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Transaction can not be of type 'credited' and have debit
     */
    public function itShouldThrowExceptionForCreditedTypeWithDebitSmallerThanZero()
    {
        new Transaction(Transaction::CREDITED, 0.0, -0.1);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Transaction can not be of type 'debited' and have credit
     */
    public function itShouldThrowExceptionForDebitedTypeWithCreditGreaterThanZero()
    {
        new Transaction(Transaction::DEBITED, 0.1, 0.0);
    }

    /**
     * @test
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Transaction can not be of type 'debited' and have credit
     */
    public function itShouldThrowExceptionForDebitedTypeWithCreditSmallerThanZero()
    {
        new Transaction(Transaction::DEBITED, -0.1, 0.0);
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Unknown type 'unknown type' for Transaction
     * @test
     */
    public function itShouldThrowExceptionForUnknownType()
    {
        new Transaction('unknown type', 0.0, 0.0);
    }
}
