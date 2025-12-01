<?php
require_once __DIR__ . '/config/config.php';
$page_title = 'Home';
include __DIR__ . '/includes/header.php';
?>

<?php

// Fetch upcoming events
$events_query = "SELECT e.*, c.category_name 
                 FROM events e 
                 LEFT JOIN categories c ON e.category_id = c.id 
                 WHERE e.status = 'upcoming' 
                 ORDER BY e.date_start ASC 
                 LIMIT 6";
$events_result = db_query($events_query);
$events = db_fetch_all($events_result);

// Fetch latest news
$news_query = "SELECT * FROM news WHERE status = 'published' ORDER BY created_at DESC LIMIT 3";
$news_result = db_query($news_query);
$news = db_fetch_all($news_result);

// Fetch sponsors
$sponsors_query = "SELECT * FROM sponsors WHERE status = 'active' ORDER BY created_at DESC LIMIT 6";
$sponsors_result = db_query($sponsors_query);
$sponsors = db_fetch_all($sponsors_result);
?>

<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 fw-bold mb-4">Welcome to DIU CIS Club</h1>
                <p class="lead mb-4">Join us in exploring the world of Computing & Information Systems. Learn, grow, and innovate with like-minded tech enthusiasts.</p>
                <div class="d-flex gap-3">
                    <?php if (!is_logged_in()): ?>
                        <a href="<?php echo SITE_URL; ?>/auth/register.php" class="btn btn-light btn-lg">
                            <i class="fas fa-user-plus"></i> Join Now
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo SITE_URL; ?>/pages/events.php" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-calendar"></i> View Events
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <img src="<?php echo SITE_URL; ?>/assets/images/hero-illustration.svg" alt="CIS Club" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Quick Actions -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                        <h4>Upcoming Events</h4>
                        <p class="text-muted">Participate in workshops, competitions, and seminars</p>
                        <a href="<?php echo SITE_URL; ?>/pages/events.php" class="btn btn-primary">Browse Events</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-newspaper fa-2x"></i>
                        </div>
                        <h4>Latest News</h4>
                        <p class="text-muted">Stay updated with club activities and achievements</p>
                        <a href="<?php echo SITE_URL; ?>/pages/news.php" class="btn btn-success">Read News</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100 text-center">
                    <div class="card-body p-4">
                        <div class="feature-icon bg-info text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <h4>Our Committee</h4>
                        <p class="text-muted">Meet the dedicated team behind CIS Club</p>
                        <a href="<?php echo SITE_URL; ?>/pages/committee.php" class="btn btn-info text-white">Meet Team</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Events -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h2 class="fw-bold">Upcoming Events</h2>
                <p class="text-muted">Don't miss out on our exciting events</p>
            </div>
        </div>
        <div class="row g-4">
            <?php if (count($events) > 0): ?>
                <?php foreach ($events as $event): ?>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <?php if ($event['image']): ?>
                                <img src="<?php echo UPLOAD_URL . $event['image']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($event['event_name']); ?>" style="height: 200px; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <i class="fas fa-calendar fa-3x"></i>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <span class="badge bg-primary mb-2"><?php echo htmlspecialchars($event['category_name'] ?? 'Event'); ?></span>
                                <h5 class="card-title"><?php echo htmlspecialchars($event['event_name']); ?></h5>
                                <p class="card-text text-muted small">
                                    <i class="fas fa-calendar"></i> <?php echo format_date($event['date_start']); ?><br>
                                    <i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($event['location']); ?>
                                </p>
                                <a href="<?php echo SITE_URL; ?>/pages/event-details.php?id=<?php echo $event['id']; ?>" class="btn btn-sm btn-outline-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">No upcoming events at the moment.</p>
                </div>
            <?php endif; ?>
        </div>
        <?php if (count($events) > 0): ?>
            <div class="text-center mt-4">
                <a href="<?php echo SITE_URL; ?>/pages/events.php" class="btn btn-primary">View All Events</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Latest News -->
<?php if (count($news) > 0): ?>
<section class="py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h2 class="fw-bold">Latest News</h2>
                <p class="text-muted">Stay informed about club activities</p>
            </div>
        </div>
        <div class="row g-4">
            <?php foreach ($news as $item): ?>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <p class="text-muted small"><i class="fas fa-clock"></i> <?php echo time_ago($item['created_at']); ?></p>
                            <h5 class="card-title"><?php echo htmlspecialchars($item['title']); ?></h5>
                            <p class="card-text"><?php echo substr(htmlspecialchars($item['description']), 0, 120); ?>...</p>
                            <a href="<?php echo SITE_URL; ?>/pages/news-details.php?id=<?php echo $item['id']; ?>" class="btn btn-sm btn-outline-success">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo SITE_URL; ?>/pages/news.php" class="btn btn-success">View All News</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Sponsors -->
<?php if (count($sponsors) > 0): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <h2 class="fw-bold">Our Sponsors</h2>
                <p class="text-muted">Thank you to our valued partners</p>
            </div>
        </div>
        <div class="row g-4 align-items-center justify-content-center">
            <?php foreach ($sponsors as $sponsor): ?>
                <div class="col-6 col-md-2 text-center">
                    <?php if ($sponsor['logo']): ?>
                        <img src="<?php echo UPLOAD_URL . $sponsor['logo']; ?>" alt="<?php echo htmlspecialchars($sponsor['sponsor_name']); ?>" class="img-fluid" style="max-height: 80px; filter: grayscale(100%); transition: all 0.3s;" onmouseover="this.style.filter='grayscale(0%)'" onmouseout="this.style.filter='grayscale(100%)'">
                    <?php else: ?>
                        <p class="fw-bold"><?php echo htmlspecialchars($sponsor['sponsor_name']); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
