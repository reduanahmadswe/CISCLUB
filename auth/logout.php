<?php
require_once __DIR__ . '/../config/config.php';

// Logout user
session_destroy();
set_message('success', 'You have been logged out successfully');
redirect(SITE_URL);
?>
