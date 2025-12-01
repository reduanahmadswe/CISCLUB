<?php
// Get current page for active nav highlighting
$current_page = basename($_SERVER['PHP_SELF']);
$current_dir = basename(dirname($_SERVER['PHP_SELF']));

// Function to check if link is active
function is_active($page_name, $dir_name = '') {
    global $current_page, $current_dir;
    if ($dir_name && $current_dir == $dir_name) return 'active';
    return ($current_page == $page_name) ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>DIU CIS Club</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/style.css">
</head>
<body>
    <!-- Fixed Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo SITE_URL; ?>">
                <i class="fas fa-graduation-cap"></i> DIU CIS Club
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_active('index.php'); ?>" href="<?php echo SITE_URL; ?>">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_active('about.php', 'pages'); ?>" href="<?php echo SITE_URL; ?>/pages/about.php">
                            <i class="fas fa-info-circle"></i> About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_active('events.php', 'pages') . ' ' . is_active('event-details.php', 'pages'); ?>" href="<?php echo SITE_URL; ?>/pages/events.php">
                            <i class="fas fa-calendar-alt"></i> Events
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_active('news.php', 'pages') . ' ' . is_active('news-details.php', 'pages'); ?>" href="<?php echo SITE_URL; ?>/pages/news.php">
                            <i class="fas fa-newspaper"></i> News
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_active('committee.php', 'pages'); ?>" href="<?php echo SITE_URL; ?>/pages/committee.php">
                            <i class="fas fa-users"></i> Committee
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo is_active('contact.php', 'pages'); ?>" href="<?php echo SITE_URL; ?>/pages/contact.php">
                            <i class="fas fa-envelope"></i> Contact
                        </a>
                    </li>
                    
                    <?php if (is_logged_in()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle"></i> My Account
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/pages/dashboard.php">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard
                                </a></li>
                                <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/pages/my-bookings.php">
                                    <i class="fas fa-ticket-alt"></i> My Bookings
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/auth/logout.php">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo is_active('login.php', 'auth'); ?>" href="<?php echo SITE_URL; ?>/auth/login.php">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light nav-link <?php echo is_active('register.php', 'auth'); ?>" href="<?php echo SITE_URL; ?>/auth/register.php">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <main class="main-content">
        <?php
        // Display flash messages
        $message = get_message();
        if ($message):
        ?>
        <div class="alert-container">
            <div class="container">
                <div class="alert alert-<?php echo $message['type']; ?> alert-dismissible fade show" role="alert">
                    <i class="fas fa-<?php echo $message['type'] == 'success' ? 'check-circle' : ($message['type'] == 'danger' ? 'exclamation-circle' : 'info-circle'); ?>"></i>
                    <?php echo $message['text']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <?php endif; ?>
