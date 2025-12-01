<?php
require_once __DIR__ . '/../config/config.php';
$page_title = 'About Us';
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
                    <li class="nav-item"><a class="nav-link active" href="<?php echo SITE_URL; ?>/pages/about.php"><i class="fas fa-info-circle"></i> About</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/pages/events.php"><i class="fas fa-calendar-alt"></i> Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/pages/news.php"><i class="fas fa-newspaper"></i> News</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/pages/committee.php"><i class="fas fa-users"></i> Committee</a></li>
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

<div class="container py-5">
    <!-- About Hero -->
    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <h1 class="display-4 fw-bold mb-3">About DIU CIS Club</h1>
            <p class="lead text-muted">Computing & Information System Club - Building Future Tech Leaders</p>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="text-primary mb-3">
                        <i class="fas fa-bullseye fa-3x"></i>
                    </div>
                    <h3 class="card-title">Our Mission</h3>
                    <p class="card-text">To create a platform where students can enhance their technical skills, collaborate on innovative projects, and prepare for successful careers in computing and information systems.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="text-success mb-3">
                        <i class="fas fa-eye fa-3x"></i>
                    </div>
                    <h3 class="card-title">Our Vision</h3>
                    <p class="card-text">To be the leading student organization in fostering innovation, technical excellence, and professional development in the field of computing and information systems.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- What We Do -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h2 class="fw-bold mb-4 text-center">What We Do</h2>
        </div>
        <div class="col-md-4 mb-3">
            <div class="text-center p-3">
                <i class="fas fa-laptop-code fa-3x text-primary mb-3"></i>
                <h5>Technical Workshops</h5>
                <p class="text-muted">Regular workshops on programming, web development, AI, and emerging technologies</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="text-center p-3">
                <i class="fas fa-trophy fa-3x text-warning mb-3"></i>
                <h5>Competitions</h5>
                <p class="text-muted">Organize programming contests, hackathons, and tech challenges</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="text-center p-3">
                <i class="fas fa-users fa-3x text-success mb-3"></i>
                <h5>Networking Events</h5>
                <p class="text-muted">Connect students with industry professionals and alumni</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="text-center p-3">
                <i class="fas fa-chalkboard-teacher fa-3x text-info mb-3"></i>
                <h5>Seminars & Talks</h5>
                <p class="text-muted">Guest lectures from industry experts and successful entrepreneurs</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="text-center p-3">
                <i class="fas fa-project-diagram fa-3x text-danger mb-3"></i>
                <h5>Project Collaboration</h5>
                <p class="text-muted">Team projects and real-world problem-solving initiatives</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="text-center p-3">
                <i class="fas fa-certificate fa-3x text-secondary mb-3"></i>
                <h5>Skill Development</h5>
                <p class="text-muted">Certification courses and career development programs</p>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row bg-primary text-white rounded p-5 mb-5">
        <div class="col-md-3 text-center mb-3">
            <h2 class="display-4 fw-bold">500+</h2>
            <p class="lead">Active Members</p>
        </div>
        <div class="col-md-3 text-center mb-3">
            <h2 class="display-4 fw-bold">50+</h2>
            <p class="lead">Events Organized</p>
        </div>
        <div class="col-md-3 text-center mb-3">
            <h2 class="display-4 fw-bold">100+</h2>
            <p class="lead">Workshops Conducted</p>
        </div>
        <div class="col-md-3 text-center mb-3">
            <h2 class="display-4 fw-bold">20+</h2>
            <p class="lead">Industry Partners</p>
        </div>
    </div>

    <!-- Join CTA -->
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="fw-bold mb-3">Ready to Join Us?</h2>
            <p class="lead mb-4">Become a part of the most dynamic tech community at DIU</p>
            <?php if (!is_logged_in()): ?>
                <a href="<?php echo SITE_URL; ?>/auth/register.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-user-plus"></i> Register Now
                </a>
            <?php else: ?>
                <a href="<?php echo SITE_URL; ?>/pages/events.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-calendar"></i> Explore Events
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
