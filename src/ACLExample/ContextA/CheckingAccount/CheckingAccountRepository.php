<?php

namespace DDDHH\ACLExample\ContextA\CheckingAccount;

/**
 * A banking account
 */
class CheckingAccountRepository
{
    const TABLE = 'checking_accounts';

    /** @var \SQLite3 */
    private $db;

    /**
     * @param \SQLite3 $db
     */
    public function __construct(\SQLite3 $db)
    {
        $this->db = $db;
    }

    /**
     * @param CheckingAccount $account
     */
    public function save(CheckingAccount $account)
    {
        $query = sprintf(
            "INSERT INTO %s (id, account) VALUES (:id, :account)",
            self::TABLE
        );

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $account->customerId(), SQLITE3_TEXT);
        $stmt->bindValue(':account', $this->encode($account), SQLITE3_BLOB);

        $stmt->execute();
    }

    /**
     * @param string $customerId
     * @return CheckingAccount|null
     */
    public function findByCustomerId(string $customerId)
    {
        $query = sprintf(
            "SELECT account FROM %s WHERE id = :id",
            self::TABLE
        );

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $customerId, SQLITE3_TEXT);

        $res = $stmt->execute();
        if ($res === false) {
            return null;
        }

        $resArray = $res->fetchArray();
        if ($resArray === false) {
            return null;
        }

        return $this->decode($resArray['account']);
    }

    /**
     * @param CheckingAccount $account
     * @return string
     */
    private function encode(CheckingAccount $account): string
    {
        return base64_encode(serialize($account));
    }

    /**
     * @param string $encodedAccount
     * @return CheckingAccount
     */
    private function decode(string $encodedAccount): CheckingAccount
    {
        return unserialize(base64_decode($encodedAccount));
    }
}
