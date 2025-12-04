<?php
require_once __DIR__ . '/../config/config.php';
$page_title = 'Events';
include __DIR__ . '/../includes/header.php';
?>

<?php

// Get filter parameters
$category_filter = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$status_filter = isset($_GET['status']) ? $_GET['status'] : 'all';

// Build query
$where = "1=1";
if ($category_filter > 0) {
    $where .= " AND e.category_id = $category_filter";
}
if ($status_filter != 'all') {
    $where .= " AND e.status = '" . db_escape($status_filter) . "'";
}

// Fetch events
$events_query = "SELECT e.*, c.category_name 
                 FROM events e 
                 LEFT JOIN categories c ON e.category_id = c.id 
                 WHERE $where 
                 ORDER BY e.date_start DESC";
$events_result = db_query($events_query);
$events = db_fetch_all($events_result);

// Fetch categories for filter
$categories_query = "SELECT * FROM categories WHERE status = 'active' ORDER BY category_name";
$categories_result = db_query($categories_query);
$categories = db_fetch_all($categories_result);
?>

<div class="container py-5">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h1 class="display-4 fw-bold">Events</h1>
            <p class="lead text-muted">Explore our upcoming workshops, competitions, and seminars</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <select name="category" class="form-select">
                                <option value="0">All Categories</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo $cat['id']; ?>" <?php echo $category_filter == $cat['id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($cat['category_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="all" <?php echo $status_filter == 'all' ? 'selected' : ''; ?>>All Events</option>
                                <option value="upcoming" <?php echo $status_filter == 'upcoming' ? 'selected' : ''; ?>>Upcoming</option>
                                <option value="ongoing" <?php echo $status_filter == 'ongoing' ? 'selected' : ''; ?>>Ongoing</option>
                                <option value="completed" <?php echo $status_filter == 'completed' ? 'selected' : ''; ?>>Completed</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter"></i> Apply Filter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Events List -->
    <div class="row g-4">
        <?php if (count($events) > 0): ?>
            <?php foreach ($events as $event): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <?php if ($event['image']): ?>
                            <img src="<?php echo htmlspecialchars($event['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($event['event_name']); ?>" style="height: 200px; object-fit: cover;" onerror="this.parentElement.innerHTML='<div class=\'bg-secondary text-white d-flex align-items-center justify-content-center\' style=\'height: 200px;\'><i class=\'fas fa-calendar fa-3x\'></i></div>'">
                        <?php else: ?>
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                <i class="fas fa-calendar fa-3x"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="badge bg-primary"><?php echo htmlspecialchars($event['category_name'] ?? 'Event'); ?></span>
                                <span class="badge bg-<?php 
                                    echo $event['status'] == 'upcoming' ? 'success' : 
                                        ($event['status'] == 'ongoing' ? 'warning' : 'secondary'); 
                                ?>"><?php echo ucfirst($event['status']); ?></span>
                            </div>
                            
                            <h5 class="card-title"><?php echo htmlspecialchars($event['event_name']); ?></h5>
                            <p class="card-text text-muted small">
                                <?php echo substr(htmlspecialchars($event['description']), 0, 100); ?>...
                            </p>
                            
                            <ul class="list-unstyled small text-muted">
                                <li><i class="fas fa-calendar"></i> <?php echo format_date($event['date_start']); ?></li>
                                <?php if ($event['time_start']): ?>
                                    <li><i class="fas fa-clock"></i> <?php echo date('h:i A', strtotime($event['time_start'])); ?></li>
                                <?php endif; ?>
                                <li><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?></li>
                            </ul>
                            
                            <a href="event-details.php?id=<?php echo $event['id']; ?>" class="btn btn-outline-primary btn-sm w-100">
                                <i class="fas fa-info-circle"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h5>No events found</h5>
                    <p>There are no events matching your criteria. Please try different filters.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
