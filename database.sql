CREATE DATABASE IF NOT EXISTS finance_app
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE finance_app;

CREATE TABLE IF NOT EXISTS users (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- One JSON document per account keeps the original app's nested features intact.
-- Transactions, bills, savings pots, plans, debts, goals, wishes and settings
-- are all stored in this account-scoped record.
CREATE TABLE IF NOT EXISTS user_states (
  user_id BIGINT UNSIGNED NOT NULL PRIMARY KEY,
  state_json LONGTEXT NOT NULL,
  updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT fk_user_states_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;
