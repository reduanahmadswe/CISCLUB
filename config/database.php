<?php
/**
 * Database Configuration
 * DIU CIS Club Portal
 */

// Database credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'cisclub_portal');

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set charset to utf8
mysqli_set_charset($conn, "utf8");

/**
 * Execute query and return result
 */
function db_query($sql) {
    global $conn;
    return mysqli_query($conn, $sql);
}

/**
 * Fetch single row as associative array
 */
function db_fetch($result) {
    return mysqli_fetch_assoc($result);
}

/**
 * Fetch all rows as associative array
 */
function db_fetch_all($result) {
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

/**
 * Escape string for SQL
 */
function db_escape($string) {
    global $conn;
    return mysqli_real_escape_string($conn, $string);
}

/**
 * Get last inserted ID
 */
function db_insert_id() {
    global $conn;
    return mysqli_insert_id($conn);
}

/**
 * Get number of affected rows
 */
function db_affected_rows() {
    global $conn;
    return mysqli_affected_rows($conn);
}
?>
