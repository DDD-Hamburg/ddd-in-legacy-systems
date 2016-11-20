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
     * @param CheckingAccount $account
     * @return string
     */
    private function encode(CheckingAccount $account): string
    {
        return base64_encode(serialize($account));
    }
}
