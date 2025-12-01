<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>Admin Panel - DIU CIS Club</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: #343a40;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            padding: 12px 20px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background: #495057;
        }
        .sidebar .nav-link i {
            width: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar p-0">
                <div class="position-sticky pt-3">
                    <div class="text-center text-white mb-4">
                        <h5><i class="fas fa-shield-alt"></i> Admin Panel</h5>
                        <small>DIU CIS Club</small>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>/index.php">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>/categories.php">
                                <i class="fas fa-tags"></i> Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>/events.php">
                                <i class="fas fa-calendar"></i> Events
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>/bookings.php">
                                <i class="fas fa-ticket-alt"></i> Bookings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>/news.php">
                                <i class="fas fa-newspaper"></i> News
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>/sponsors.php">
                                <i class="fas fa-handshake"></i> Sponsors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>/committee.php">
                                <i class="fas fa-users"></i> Committee
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>/users.php">
                                <i class="fas fa-user-friends"></i> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>/messages.php">
                                <i class="fas fa-envelope"></i> Messages
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" href="<?php echo SITE_URL; ?>" target="_blank">
                                <i class="fas fa-external-link-alt"></i> View Site
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ADMIN_URL; ?>/logout.php">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto px-md-4">
                <div class="pt-3 pb-2 mb-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h1 class="h2"><?php echo $page_title ?? 'Dashboard'; ?></h1>
                        <div class="text-muted">
                            <i class="fas fa-user"></i> <?php echo $_SESSION['admin_name'] ?? 'Admin'; ?>
                        </div>
                    </div>
                </div>

                <?php
                $message = get_message();
                if ($message):
                ?>
                <div class="alert alert-<?php echo $message['type']; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message['text']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
