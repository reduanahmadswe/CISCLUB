<?php
require_once __DIR__ . '/../config/config.php';

if (!is_admin_logged_in()) {
    redirect(ADMIN_URL . '/login.php');
}

$page_title = 'Dashboard';

// Fetch statistics
$stats = [];

// Total users
$users_query = "SELECT COUNT(*) as total FROM users";
$stats['users'] = db_fetch(db_query($users_query))['total'];

// Total events
$events_query = "SELECT COUNT(*) as total FROM events";
$stats['events'] = db_fetch(db_query($events_query))['total'];

// Total bookings
$bookings_query = "SELECT COUNT(*) as total FROM event_registrations";
$stats['bookings'] = db_fetch(db_query($bookings_query))['total'];

// Pending bookings
$pending_query = "SELECT COUNT(*) as total FROM event_registrations WHERE status = 'pending'";
$stats['pending'] = db_fetch(db_query($pending_query))['total'];

// Total news
$news_query = "SELECT COUNT(*) as total FROM news";
$stats['news'] = db_fetch(db_query($news_query))['total'];

// Total sponsors
$sponsors_query = "SELECT COUNT(*) as total FROM sponsors WHERE status = 'active'";
$stats['sponsors'] = db_fetch(db_query($sponsors_query))['total'];

// Unread messages
$messages_query = "SELECT COUNT(*) as total FROM contact_messages WHERE status = 'unread'";
$stats['messages'] = db_fetch(db_query($messages_query))['total'];

// Recent bookings
$recent_bookings_query = "SELECT er.*, u.full_name, e.event_name 
                          FROM event_registrations er 
                          JOIN users u ON er.user_id = u.id 
                          JOIN events e ON er.event_id = e.id 
                          ORDER BY er.registration_date DESC 
                          LIMIT 5";
$recent_bookings = db_fetch_all(db_query($recent_bookings_query));

include __DIR__ . '/includes/header.php';
?>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-primary text-white">
            <div class="card-body text-center">
                <i class="fas fa-users fa-3x mb-2"></i>
                <h3 class="fw-bold"><?php echo $stats['users']; ?></h3>
                <p class="mb-0">Total Users</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-success text-white">
            <div class="card-body text-center">
                <i class="fas fa-calendar fa-3x mb-2"></i>
                <h3 class="fw-bold"><?php echo $stats['events']; ?></h3>
                <p class="mb-0">Total Events</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-info text-white">
            <div class="card-body text-center">
                <i class="fas fa-ticket-alt fa-3x mb-2"></i>
                <h3 class="fw-bold"><?php echo $stats['bookings']; ?></h3>
                <p class="mb-0">Total Bookings</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-0 shadow-sm bg-warning text-dark">
            <div class="card-body text-center">
                <i class="fas fa-clock fa-3x mb-2"></i>
                <h3 class="fw-bold"><?php echo $stats['pending']; ?></h3>
                <p class="mb-0">Pending Bookings</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="fas fa-newspaper fa-2x text-success mb-2"></i>
                <h4 class="fw-bold"><?php echo $stats['news']; ?></h4>
                <p class="text-muted mb-0">News Published</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="fas fa-handshake fa-2x text-info mb-2"></i>
                <h4 class="fw-bold"><?php echo $stats['sponsors']; ?></h4>
                <p class="text-muted mb-0">Active Sponsors</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center">
                <i class="fas fa-envelope fa-2x text-danger mb-2"></i>
                <h4 class="fw-bold"><?php echo $stats['messages']; ?></h4>
                <p class="text-muted mb-0">Unread Messages</p>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white">
                <h5 class="fw-bold mb-0"><i class="fas fa-history"></i> Recent Bookings</h5>
            </div>
            <div class="card-body">
                <?php if (count($recent_bookings) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Event</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_bookings as $booking): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($booking['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($booking['event_name']); ?></td>
                                        <td>
                                            <span class="badge bg-<?php 
                                                echo $booking['status'] == 'confirmed' ? 'success' : 
                                                    ($booking['status'] == 'pending' ? 'warning' : 'danger'); 
                                            ?>"><?php echo ucfirst($booking['status']); ?></span>
                                        </td>
                                        <td><?php echo time_ago($booking['registration_date']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <a href="bookings.php" class="btn btn-primary">View All Bookings</a>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center">No bookings yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
