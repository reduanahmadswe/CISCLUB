<?php
require_once __DIR__ . '/../config/config.php';

$news_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

$news_query = "SELECT * FROM news WHERE id = $news_id AND status = 'published'";
$news_result = db_query($news_query);

if (!$news_result || mysqli_num_rows($news_result) == 0) {
    redirect(SITE_URL . '/pages/news.php');
}

$news = db_fetch($news_result);
$page_title = $news['title'];
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
                    <li class="nav-item"><a class="nav-link active" href="<?php echo SITE_URL; ?>/pages/news.php"><i class="fas fa-newspaper"></i> News</a></li>
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="<?php echo SITE_URL; ?>/pages/news.php" class="btn btn-sm btn-outline-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Back to News
            </a>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <p class="text-muted">
                        <i class="fas fa-clock"></i> <?php echo format_date($news['created_at']); ?>
                    </p>
                    <h1 class="fw-bold mb-4"><?php echo htmlspecialchars($news['title']); ?></h1>
                    <div class="news-content">
                        <?php echo nl2br(htmlspecialchars($news['description'])); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
