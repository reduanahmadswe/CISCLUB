<?php
require_once __DIR__ . '/../config/config.php';

if (!is_logged_in()) {
    redirect(SITE_URL . '/auth/login.php');
}

$page_title = 'My Bookings';
$user_id = get_user_id();

// Fetch user's bookings
$bookings_query = "SELECT er.*, e.event_name, e.date_start, e.location, e.image, c.category_name 
                   FROM event_registrations er 
                   JOIN events e ON er.event_id = e.id 
                   LEFT JOIN categories c ON e.category_id = c.id 
                   WHERE er.user_id = $user_id 
                   ORDER BY er.registration_date DESC";
$bookings_result = db_query($bookings_query);
$bookings = db_fetch_all($bookings_result);

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
                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/pages/committee.php"><i class="fas fa-users"></i> Committee</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo SITE_URL; ?>/pages/contact.php"><i class="fas fa-envelope"></i> Contact</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown"><i class="fas fa-user-circle"></i> My Account</a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/pages/dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                            <li><a class="dropdown-item active" href="<?php echo SITE_URL; ?>/pages/my-bookings.php"><i class="fas fa-ticket-alt"></i> My Bookings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="main-content">

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="fw-bold">My Event Bookings</h1>
            <p class="text-muted">View and manage your event registrations</p>
        </div>
    </div>

    <div class="row">
        <?php if (count($bookings) > 0): ?>
            <?php foreach ($bookings as $booking): ?>
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-primary"><?php echo htmlspecialchars($booking['category_name'] ?? 'Event'); ?></span>
                                <span class="badge bg-<?php 
                                    echo $booking['status'] == 'confirmed' ? 'success' : 
                                        ($booking['status'] == 'pending' ? 'warning' : 'danger'); 
                                ?>"><?php echo ucfirst($booking['status']); ?></span>
                            </div>
                            
                            <h5 class="fw-bold"><?php echo htmlspecialchars($booking['event_name']); ?></h5>
                            
                            <ul class="list-unstyled text-muted small mb-3">
                                <li><i class="fas fa-calendar"></i> <?php echo format_date($booking['date_start']); ?></li>
                                <li><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($booking['location']); ?></li>
                                <li><i class="fas fa-clock"></i> Registered: <?php echo time_ago($booking['registration_date']); ?></li>
                            </ul>
                            
                            <a href="<?php echo SITE_URL; ?>/pages/event-details.php?id=<?php echo $booking['event_id']; ?>" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-info-circle"></i> View Event
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h5>No bookings yet</h5>
                    <p>You haven't registered for any events.</p>
                    <a href="<?php echo SITE_URL; ?>/pages/events.php" class="btn btn-primary">
                        <i class="fas fa-calendar"></i> Browse Events
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
