<?php

namespace DDDHH\ACLExample\ContextA\CheckingAccount;

use PHPUnit\Framework\TestCase;

class CheckingAccountRepositoryTest extends TestCase
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
            CheckingAccountRepository::TABLE
        ));
    }

    /**
     * @test
     */
    public function itShouldStoreCheckingAccount()
    {
        $repo = new CheckingAccountRepository($this->db);

        $customerId = 'FFSS-123';
        $account = $this->aCheckingAccount($customerId);

        $repo->save($account);

        $res = $this->db->query('SELECT count(*) AS cnt from checking_accounts');
        $this->assertEquals(1, $res->fetchArray()['cnt']);
    }

    /**
     * @test
     */
    public function itShouldFindCheckingAccountByCustomerId()
    {
        $repo = new CheckingAccountRepository($this->db);

        $customerId = 'FFSS-123';
        $expectedAccount = $this->aCheckingAccount($customerId);

        $repo->save($expectedAccount);

        $account = $repo->findByCustomerId($customerId);

        $this->assertEquals($expectedAccount, $account);
    }

    /**
     * @param string $customerId
     * @return CheckingAccount
     */
    private function aCheckingAccount(string $customerId): CheckingAccount
    {
        $account = new CheckingAccount($customerId);

        $account->deposit(new Deposit(150.0, true));
        $account->deposit(new Deposit(50.0, false));

        $account->withdraw(new Withdrawal(70.0));

        $account->transfer(new Transfer(10.0, true));
        $account->transfer(new Transfer(15.0, false));

        return $account;
    }
}
