<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cardapio_digital');

// Application configuration
define('BASE_URL', 'http://localhost/cardapio-digital');
define('APP_NAME', 'Cardápio Digital');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session configuration
session_start();
?> 