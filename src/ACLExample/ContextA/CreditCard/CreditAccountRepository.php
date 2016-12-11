<?php

namespace DDDHH\ACLExample\ContextA\CreditAccount;

/**
 * A credit account repository
 */
class CreditAccountRepository
{
    const TABLE = 'credit_accounts';

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
     * @param CreditAccount $account
     */
    public function save(CreditAccount $account)
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
     * @return CreditAccount|null
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
     * @param CreditAccount $account
     * @return string
     */
    private function encode(CreditAccount $account): string
    {
        return base64_encode(serialize($account));
    }

    /**
     * @param string $encodedAccount
     * @return CreditAccount
     */
    private function decode(string $encodedAccount): CreditAccount
    {
        return unserialize(base64_decode($encodedAccount));
    }
}
