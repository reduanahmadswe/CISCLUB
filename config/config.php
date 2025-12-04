<?php
/**
 * Global Configuration
 * DIU CIS Club Portal
 */

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Site Configuration
define('SITE_NAME', 'DIU CIS Club');
define('SITE_URL', 'http://localhost/CISCLUB');
define('ADMIN_URL', SITE_URL . '/admin');

// File Upload Configuration
define('UPLOAD_PATH', dirname(__DIR__) . '/uploads/');
define('UPLOAD_URL', SITE_URL . '/uploads/');
define('MAX_FILE_SIZE', 5242880); // 5MB

// Pagination
define('ITEMS_PER_PAGE', 10);

// Date/Time Format
define('DATE_FORMAT', 'Y-m-d');
define('DATETIME_FORMAT', 'Y-m-d H:i:s');
define('DISPLAY_DATE_FORMAT', 'F d, Y');

// Include database
require_once __DIR__ . '/database.php';

/**
 * Helper Functions
 */

// Redirect function
function redirect($url) {
    header("Location: $url");
    exit();
}

// Display alert message
function set_message($type, $message) {
    $_SESSION['message'] = [
        'type' => $type,
        'text' => $message
    ];
}

// Get and clear message
function get_message() {
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }
    return null;
}

// Check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Check if admin is logged in
function is_admin_logged_in() {
    return isset($_SESSION['admin_id']);
}

// Get current user ID
function get_user_id() {
    return $_SESSION['user_id'] ?? null;
}

// Get current admin ID
function get_admin_id() {
    return $_SESSION['admin_id'] ?? null;
}

// Sanitize input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Format date for display
function format_date($date) {
    return date(DISPLAY_DATE_FORMAT, strtotime($date));
}

// Time ago function
function time_ago($datetime) {
    $timestamp = strtotime($datetime);
    $difference = time() - $timestamp;
    
    if ($difference < 60) return 'Just now';
    if ($difference < 3600) return floor($difference / 60) . ' minutes ago';
    if ($difference < 86400) return floor($difference / 3600) . ' hours ago';
    if ($difference < 604800) return floor($difference / 86400) . ' days ago';
    
    return date(DISPLAY_DATE_FORMAT, $timestamp);
}

// Upload file function
function upload_file($file, $folder = '') {
    if (!isset($file) || $file['error'] != 0) {
        return false;
    }
    
    $upload_dir = UPLOAD_PATH . $folder;
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $file_name = time() . '_' . basename($file['name']);
    $target_file = $upload_dir . '/' . $file_name;
    
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        return $folder . '/' . $file_name;
    }
    
    return false;
}

// Delete file function
function delete_file($file_path) {
    $full_path = UPLOAD_PATH . $file_path;
    if (file_exists($full_path)) {
        return unlink($full_path);
    }
    return false;
}

// Generate clean URL for router
function route($path) {
    return SITE_URL . $path;
}

// Get current route
function current_route() {
    $request_uri = $_SERVER['REQUEST_URI'];
    $base_path = parse_url(SITE_URL, PHP_URL_PATH);
    $route = str_replace($base_path, '', parse_url($request_uri, PHP_URL_PATH));
    return '/' . trim($route, '/');
}

// Check if current route matches
function is_current_route($route) {
    return current_route() === $route;
}
?>
