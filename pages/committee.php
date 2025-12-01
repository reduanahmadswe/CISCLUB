<?php
require_once __DIR__ . '/../config/config.php';
$page_title = 'Committee Members';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - DIU CIS Club</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URL; ?>/assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo SITE_URL; ?>">
                <i class="fas fa-graduation-cap"></i> DIU CIS Club
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>"><i class="fas fa-home"></i> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/pages/about.php"><i class="fas fa-info-circle"></i> About</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/pages/events.php"><i class="fas fa-calendar-alt"></i> Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/pages/news.php"><i class="fas fa-newspaper"></i> News</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo SITE_URL; ?>/pages/committee.php"><i class="fas fa-users"></i> Committee</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/pages/contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                    <?php if (is_logged_in()): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="fas fa-user-circle"></i> My Account</a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/pages/dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/pages/my-bookings.php"><i class="fas fa-ticket-alt"></i> My Bookings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/auth/login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                        <li class="nav-item"><a class="btn btn-light nav-link" href="<?php echo SITE_URL; ?>/auth/register.php"><i class="fas fa-user-plus"></i> Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="main-content">

<?php

// Fetch committee members
$members_query = "SELECT * FROM committee_members WHERE status = 'active' ORDER BY display_order ASC, created_at ASC";
$members_result = db_query($members_query);
$members = db_fetch_all($members_result);
?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h1 class="display-4 fw-bold">Our Committee</h1>
            <p class="lead text-muted">Meet the dedicated team behind DIU CIS Club</p>
        </div>
    </div>

    <div class="row g-4">
        <?php if (count($members) > 0): ?>
            <?php foreach ($members as $member): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <?php if ($member['image']): ?>
                                <img src="<?php echo UPLOAD_URL . $member['image']; ?>" 
                                     class="rounded-circle mb-3" 
                                     alt="<?php echo htmlspecialchars($member['full_name']); ?>"
                                     style="width: 120px; height: 120px; object-fit: cover;">
                            <?php else: ?>
                                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" 
                                     style="width: 120px; height: 120px;">
                                    <i class="fas fa-user fa-3x"></i>
                                </div>
                            <?php endif; ?>
                            
                            <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($member['full_name']); ?></h5>
                            <p class="text-primary mb-3"><?php echo htmlspecialchars($member['position']); ?></p>
                            
                            <?php if ($member['email']): ?>
                                <p class="small mb-2">
                                    <i class="fas fa-envelope"></i> <?php echo htmlspecialchars($member['email']); ?>
                                </p>
                            <?php endif; ?>
                            
                            <div class="social-links">
                                <?php if ($member['facebook']): ?>
                                    <a href="<?php echo htmlspecialchars($member['facebook']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($member['linkedin']): ?>
                                    <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h5>Committee information will be updated soon</h5>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
