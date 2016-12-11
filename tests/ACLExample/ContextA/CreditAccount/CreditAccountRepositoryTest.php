<?php

namespace DDDHH\ACLExample\ContextA\CreditAccount;

use PHPUnit\Framework\TestCase;

class CreditAccountRepositoryTest extends TestCase
{
    /** @var SQLite3 */
    private $db;

    protected function setUp()
    {
        $file = realpath(__DIR__ . '/../../../../db/test.db');
        $this->db = new \SQLite3($file);
    }

    protected function tearDown()
    {
        $this->db->exec(sprintf('DELETE FROM %s',
            CreditAccountRepository::TABLE
        ));
    }

    /**
     * @test
     */
    public function itShouldStoreCreditAccount()
    {
        $repo = new CreditAccountRepository($this->db);

        $customerId = 'FFSS-123';
        $account = $this->aCreditAccount($customerId);

        $repo->save($account);

        $res = $this->db->query('SELECT count(*) AS cnt from credit_accounts');
        $this->assertEquals(1, $res->fetchArray()['cnt']);
    }

    /**
     * @test
     */
    public function itShouldFindCreditAccountByCustomerId()
    {
        $repo = new CreditAccountRepository($this->db);

        $customerId = 'FFSS-123';
        $expectedAccount = $this->aCreditAccount($customerId);

        $repo->save($expectedAccount);

        $account = $repo->findByCustomerId($customerId);

        $this->assertEquals($expectedAccount, $account);
    }

    /**
     * @param string $customerId
     * @return CreditAccount
     */
    private function aCreditAccount(string $customerId): CreditAccount
    {
        $account = new CreditAccount($customerId, 2000.0);

        $account->charge(new Charge(150.0));
        $account->charge(new Charge(250.0));
        $account->charge(new Charge(-50.0));

        return $account;
    }
}
