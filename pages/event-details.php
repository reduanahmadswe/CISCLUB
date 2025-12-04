<?php
require_once __DIR__ . '/../config/config.php';

// Get event ID
$event_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch event details
$event_query = "SELECT e.*, c.category_name 
                FROM events e 
                LEFT JOIN categories c ON e.category_id = c.id 
                WHERE e.id = $event_id";
$event_result = db_query($event_query);

if (!$event_result || mysqli_num_rows($event_result) == 0) {
    redirect(SITE_URL . '/pages/events.php');
}

$event = db_fetch($event_result);
$page_title = $event['event_name'];

// Check if user already registered
$already_registered = false;
if (is_logged_in()) {
    $user_id = get_user_id();
    $check_query = "SELECT id FROM event_registrations WHERE event_id = $event_id AND user_id = $user_id";
    $check_result = db_query($check_query);
    $already_registered = mysqli_num_rows($check_result) > 0;
}

// Handle registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    if (!is_logged_in()) {
        set_message('warning', 'Please login to register for events');
        redirect(SITE_URL . '/auth/login.php');
    }
    
    $user_id = get_user_id();
    $insert_query = "INSERT INTO event_registrations (event_id, user_id, status) 
                     VALUES ($event_id, $user_id, 'pending')";
    
    if (db_query($insert_query)) {
        set_message('success', 'Registration submitted successfully! Please wait for confirmation.');
        redirect(SITE_URL . '/pages/event-details.php?id=' . $event_id);
    } else {
        set_message('danger', 'Registration failed. Please try again.');
    }
}

include __DIR__ . '/../includes/header.php';
?>
<div class="container py-5">
    <div class="row">
        <!-- Event Image -->
        <div class="col-md-8 mb-4">
            <?php if ($event['image']): ?>
                <?php 
                // Check if image is full URL or relative path
                $image_url = (strpos($event['image'], 'http') === 0) ? $event['image'] : UPLOAD_URL . $event['image'];
                ?>
                <img src="<?php echo $image_url; ?>" class="img-fluid rounded shadow" alt="<?php echo htmlspecialchars($event['event_name']); ?>" onerror="this.parentElement.innerHTML='<div class=\'bg-secondary text-white d-flex align-items-center justify-content-center rounded\' style=\'height: 400px;\'><i class=\'fas fa-calendar fa-5x\'></i></div>'">
            <?php else: ?>
                <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded" style="height: 400px;">
                    <i class="fas fa-calendar fa-5x"></i>
                </div>
            <?php endif; ?>
            
            <!-- Event Details -->
            <div class="mt-4">
                <div class="d-flex justify-content-between mb-3">
                    <span class="badge bg-primary fs-6"><?php echo htmlspecialchars($event['category_name'] ?? 'Event'); ?></span>
                    <span class="badge bg-<?php 
                        echo $event['status'] == 'upcoming' ? 'success' : 
                            ($event['status'] == 'ongoing' ? 'warning' : 'secondary'); 
                    ?> fs-6"><?php echo ucfirst($event['status']); ?></span>
                </div>
                
                <h1 class="fw-bold mb-3"><?php echo htmlspecialchars($event['event_name']); ?></h1>
                
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <i class="fas fa-calendar text-primary"></i>
                                <strong>Date:</strong> <?php echo format_date($event['date_start']); ?>
                                <?php if ($event['date_end']): ?>
                                    - <?php echo format_date($event['date_end']); ?>
                                <?php endif; ?>
                            </div>
                            <?php if ($event['time_start']): ?>
                                <div class="col-md-6 mb-3">
                                    <i class="fas fa-clock text-primary"></i>
                                    <strong>Time:</strong> <?php echo date('h:i A', strtotime($event['time_start'])); ?>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-6 mb-3">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                                <strong>Location:</strong> <?php echo htmlspecialchars($event['location']); ?>
                            </div>
                            <?php if ($event['max_participants']): ?>
                                <div class="col-md-6 mb-3">
                                    <i class="fas fa-users text-primary"></i>
                                    <strong>Max Participants:</strong> <?php echo $event['max_participants']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <h4 class="fw-bold mb-3">About This Event</h4>
                <div class="text-muted">
                    <?php echo nl2br(htmlspecialchars($event['description'])); ?>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-md-4">
            <div class="card shadow-sm sticky-top" style="top: 20px;">
                <div class="card-body">
                    <?php if ($event['status'] == 'upcoming'): ?>
                        <?php if (is_logged_in()): ?>
                            <?php if ($already_registered): ?>
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i> You are registered for this event
                                </div>
                                <a href="<?php echo SITE_URL; ?>/pages/my-bookings.php" class="btn btn-primary w-100">
                                    <i class="fas fa-list"></i> View My Bookings
                                </a>
                            <?php else: ?>
                                <form method="POST">
                                    <button type="submit" name="register" class="btn btn-success w-100 btn-lg mb-3">
                                        <i class="fas fa-check-circle"></i> Register Now
                                    </button>
                                </form>
                                <p class="text-muted small text-center">Click to register for this event</p>
                            <?php endif; ?>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> Please login to register
                            </div>
                            <a href="<?php echo SITE_URL; ?>/auth/login.php" class="btn btn-primary w-100 mb-2">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                            <a href="<?php echo SITE_URL; ?>/auth/register.php" class="btn btn-outline-primary w-100">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        <?php endif; ?>
                    <?php elseif ($event['status'] == 'ongoing'): ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-hourglass-half"></i> This event is currently ongoing
                        </div>
                    <?php else: ?>
                        <div class="alert alert-secondary">
                            <i class="fas fa-check"></i> This event has been completed
                        </div>
                    <?php endif; ?>
                    
                    <hr>
                    
                    <h5 class="fw-bold mb-3">Share This Event</h5>
                    <div class="d-flex gap-2">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(SITE_URL . '/pages/event-details.php?id=' . $event_id); ?>" 
                           target="_blank" class="btn btn-primary flex-fill">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(SITE_URL . '/pages/event-details.php?id=' . $event_id); ?>&text=<?php echo urlencode($event['event_name']); ?>" 
                           target="_blank" class="btn btn-info flex-fill">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(SITE_URL . '/pages/event-details.php?id=' . $event_id); ?>" 
                           target="_blank" class="btn btn-primary flex-fill">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="mt-3 text-center">
                <a href="<?php echo SITE_URL; ?>/pages/events.php" class="text-muted">
                    <i class="fas fa-arrow-left"></i> Back to Events
                </a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
