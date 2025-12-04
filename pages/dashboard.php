<?php
require_once __DIR__ . '/../config/config.php';

if (!is_logged_in()) {
    redirect(SITE_URL . '/auth/login.php');
}

$page_title = 'Dashboard';
$user_id = get_user_id();

// Fetch user info
$user_query = "SELECT * FROM users WHERE id = $user_id";
$user_result = db_query($user_query);
$user = db_fetch($user_result);

// Count user's bookings
$bookings_query = "SELECT COUNT(*) as total FROM event_registrations WHERE user_id = $user_id";
$bookings_result = db_query($bookings_query);
$bookings_count = db_fetch($bookings_result)['total'];

// Count upcoming events user registered for
$upcoming_query = "SELECT COUNT(*) as total FROM event_registrations er 
                   JOIN events e ON er.event_id = e.id 
                   WHERE er.user_id = $user_id AND e.status = 'upcoming' AND er.status = 'confirmed'";
$upcoming_result = db_query($upcoming_query);
$upcoming_count = db_fetch($upcoming_result)['total'];

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="fw-bold">Welcome, <?php echo htmlspecialchars($user['full_name']); ?>!</h1>
            <p class="text-muted">Manage your profile and event registrations</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body text-center p-4">
                    <i class="fas fa-calendar-check fa-3x mb-3"></i>
                    <h2 class="fw-bold"><?php echo $bookings_count; ?></h2>
                    <p class="mb-0">Total Bookings</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body text-center p-4">
                    <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                    <h2 class="fw-bold"><?php echo $upcoming_count; ?></h2>
                    <p class="mb-0">Upcoming Events</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-info text-white">
                <div class="card-body text-center p-4">
                    <i class="fas fa-user-check fa-3x mb-3"></i>
                    <h2 class="fw-bold"><?php echo ucfirst($user['status']); ?></h2>
                    <p class="mb-0">Account Status</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Profile Information -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0"><i class="fas fa-user"></i> Profile Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-bold">Full Name:</td>
                            <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Username:</td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Email:</td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                        </tr>
                        <?php if ($user['student_id']): ?>
                        <tr>
                            <td class="fw-bold">Student ID:</td>
                            <td><?php echo htmlspecialchars($user['student_id']); ?></td>
                        </tr>
                        <?php endif; ?>
                        <?php if ($user['phone']): ?>
                        <tr>
                            <td class="fw-bold">Phone:</td>
                            <td><?php echo htmlspecialchars($user['phone']); ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td class="fw-bold">Member Since:</td>
                            <td><?php echo format_date($user['registration_date']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="fw-bold mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="<?php echo SITE_URL; ?>/pages/events.php" class="btn btn-outline-primary">
                            <i class="fas fa-calendar"></i> Browse Events
                        </a>
                        <a href="<?php echo SITE_URL; ?>/pages/my-bookings.php" class="btn btn-outline-success">
                            <i class="fas fa-list"></i> My Bookings
                        </a>
                        <a href="<?php echo SITE_URL; ?>/pages/news.php" class="btn btn-outline-info">
                            <i class="fas fa-newspaper"></i> Latest News
                        </a>
                        <a href="<?php echo SITE_URL; ?>/auth/logout.php" class="btn btn-outline-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
