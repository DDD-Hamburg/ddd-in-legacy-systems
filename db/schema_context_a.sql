CREATE TABLE IF NOT EXISTS checking_accounts (
        -- length of uniqid()
        id CHAR(13) PRIMARY KEY,
        account BLOB
);

CREATE TABLE IF NOT EXISTS credit_accounts (
        -- length of uniqid()
        id CHAR(13) PRIMARY KEY,
        account BLOB
);
