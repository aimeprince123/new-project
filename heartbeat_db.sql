CREATE DATABASE IF NOT EXISTS heartbeat_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE heartbeat_db;

CREATE TABLE IF NOT EXISTS heartbeat_readings (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    bpm SMALLINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_created_at (created_at)
);
