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

include __DIR__ . '/../includes/header.php';
?>

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
