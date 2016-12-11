<?php

namespace DDDHH\ACLExample\ContextB\ChequeingAccount;

use PHPUnit\Framework\TestCase;

class ChequeingAccountTest extends TestCase
{
    /**
     * @notest
     */
    public function itShouldAddTransaction()
    {
        $account = new ChequeingAccount();

        $account->addTransaction(new Transaction(150.0, true));
        $account->addTransaction(new Transaction(150.0, true));

        $this->assertEquals(115.0, $account->balance());
    }
}
