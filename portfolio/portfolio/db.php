<?php
/* =========================================
   DB CONNECTION — portfolio_db
   Auto-creates database & table if missing
========================================= */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');       // ← Change if your MySQL has a password
define('DB_NAME', 'portfolio_db');

// Step 1: Connect without selecting DB
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
if ($conn->connect_error) {
    die('<p style="color:red;font-family:monospace;padding:20px">
        ❌ MySQL Connection Failed: ' . $conn->connect_error . '<br>
        Make sure XAMPP MySQL is running.
    </p>');
}

// Step 2: Create database if it doesn't exist
$conn->query("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "`
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$conn->select_db(DB_NAME);
$conn->set_charset('utf8mb4');

// Step 3: Create messages table if missing
$conn->query("
    CREATE TABLE IF NOT EXISTS `messages` (
        `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `name`       VARCHAR(150) NOT NULL,
        `email`      VARCHAR(150) NOT NULL,
        `message`    TEXT NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
");
?>
