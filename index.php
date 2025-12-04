<?php
require_once __DIR__ . '/config/config.php';
$page_title = 'Home';
include __DIR__ . '/includes/header.php';
?>

<?php

// Fetch stats from database
$stats_query = "SELECT 
    (SELECT COUNT(*) FROM users WHERE status = 'active') as active_members,
    (SELECT COUNT(*) FROM events) as total_events";
$stats_result = db_query($stats_query);
$stats = db_fetch($stats_result);

$active_members = $stats['active_members'] ?? 0;
$total_events = $stats['total_events'] ?? 0;

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
<section class="hero-section text-white position-relative" style="min-height: 100vh; overflow: hidden; display: flex; align-items: center;">
    <!-- Background Image with Overlay -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index: 0;">
        <img src="<?php echo SITE_URL; ?>/assets/images/hero-illustration.png?v=<?php echo time(); ?>" 
             alt="CIS Club Background" 
             class="w-100 h-100" 
             style="object-fit: cover; opacity: 0.5; filter: brightness(0.9);" 
             onerror="this.parentElement.style.background='linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #ec4899 100%)'">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.5) 0%, rgba(139, 92, 246, 0.45) 50%, rgba(236, 72, 153, 0.4) 100%);"></div>
    </div>
    
    <!-- Animated Particles -->
    <div class="position-absolute top-0 start-0 w-100 h-100" style="z-index: 0; pointer-events: none;">
        <div class="hero-particle" style="top: 10%; left: 10%;"></div>
        <div class="hero-particle" style="top: 20%; right: 15%; animation-delay: 1s;"></div>
        <div class="hero-particle" style="bottom: 30%; left: 20%; animation-delay: 2s;"></div>
        <div class="hero-particle" style="bottom: 20%; right: 10%; animation-delay: 1.5s;"></div>
        <div class="hero-particle" style="top: 60%; left: 5%; animation-delay: 0.5s;"></div>
        <div class="hero-particle" style="top: 40%; right: 25%; animation-delay: 2.5s;"></div>
    </div>
    
    <!-- Content -->
    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-10 col-md-11 mx-auto text-center">
                <!-- Badge -->
                <div class="mb-4" data-aos="fade-down">
                    <span class="badge rounded-pill px-4 py-2" style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); font-size: 1rem; font-weight: 500;">
                        <i class="fas fa-star me-2"></i>Welcome to DIU Computing & Information System Club
                    </span>
                </div>
                
                <!-- Main Heading -->
                <h1 class="display-2 fw-bold mb-4" data-aos="fade-up" data-aos-delay="100" style="text-shadow: 2px 4px 12px rgba(0,0,0,0.3); line-height: 1.2;">
                    Building Future Tech Leaders
                </h1>
                
                <!-- Subheading -->
                <p class="lead mb-5 fs-3 mx-auto" data-aos="fade-up" data-aos-delay="200" style="max-width: 800px; text-shadow: 1px 2px 8px rgba(0,0,0,0.2);">
                    Join us in exploring the world of Computing & Information Systems. Learn, grow, and innovate with like-minded tech enthusiasts.
                </p>
                
                <!-- CTA Buttons -->
                <div class="d-flex gap-3 justify-content-center flex-wrap mb-5" data-aos="fade-up" data-aos-delay="300">
                    <?php if (!is_logged_in()): ?>
                        <a href="<?php echo SITE_URL; ?>/auth/register.php" class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow-lg hero-btn">
                            <i class="fas fa-user-plus me-2"></i> Join Now
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo SITE_URL; ?>/pages/events.php" class="btn btn-outline-light btn-lg px-5 py-3 rounded-pill shadow-lg hero-btn-outline">
                        <i class="fas fa-calendar me-2"></i> Explore Events
                    </a>
                </div>
                
                <!-- Stats Cards -->
                <div class="row g-4 mt-5 pt-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="col-md-4">
                        <div class="stat-card p-4 rounded-4" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                            <div class="stat-icon mb-3">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                            <h2 class="display-4 fw-bold mb-1 counter" data-target="<?php echo $active_members; ?>">0</h2>
                            <p class="mb-0 fs-5 opacity-90">Active Members</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card p-4 rounded-4" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                            <div class="stat-icon mb-3">
                                <i class="fas fa-calendar-check fa-2x"></i>
                            </div>
                            <h2 class="display-4 fw-bold mb-1 counter" data-target="<?php echo $total_events; ?>">0</h2>
                            <p class="mb-0 fs-5 opacity-90">Events Organized</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card p-4 rounded-4" style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2);">
                            <div class="stat-icon mb-3">
                                <i class="fas fa-trophy fa-2x"></i>
                            </div>
                            <h2 class="display-4 fw-bold mb-1">100%</h2>
                            <p class="mb-0 fs-5 opacity-90">Student Satisfaction</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4" style="z-index: 1; animation: bounce 2s infinite;">
        <i class="fas fa-chevron-down fa-2x opacity-75"></i>
    </div>
</section>

<style>
/* Hero Button Styles */
.hero-btn {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    font-weight: 600;
    letter-spacing: 0.5px;
}

.hero-btn:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 15px 40px rgba(255, 255, 255, 0.4) !important;
    background: white !important;
    color: #6366f1 !important;
}

.hero-btn-outline {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    font-weight: 600;
    letter-spacing: 0.5px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
}

.hero-btn-outline:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 15px 40px rgba(255, 255, 255, 0.3) !important;
    background: white !important;
    color: #6366f1 !important;
    border-color: white !important;
}

/* Stat Cards */
.stat-card {
    transition: all 0.4s ease;
}

.stat-card:hover {
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.25) !important;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
}

.stat-icon {
    animation: pulse 2s ease-in-out infinite;
}

/* Particles */
.hero-particle {
    position: absolute;
    width: 10px;
    height: 10px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    animation: float-particle 4s ease-in-out infinite;
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
}

@keyframes float-particle {
    0%, 100% {
        transform: translateY(0) scale(1);
        opacity: 0.5;
    }
    50% {
        transform: translateY(-30px) scale(1.2);
        opacity: 1;
    }
}

@keyframes bounce {
    0%, 100% {
        transform: translateX(-50%) translateY(0);
    }
    50% {
        transform: translateX(-50%) translateY(-10px);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .hero-section h1 {
        font-size: 2.5rem !important;
    }
    .hero-section .lead {
        font-size: 1.1rem !important;
    }
}
</style>

<!-- AOS Library for scroll animations -->
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>

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
                                <?php 
                                // Check if image is full URL or relative path
                                $image_url = (strpos($event['image'], 'http') === 0) ? $event['image'] : UPLOAD_URL . $event['image'];
                                ?>
                                <img src="<?php echo $image_url; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($event['event_name']); ?>" style="height: 200px; object-fit: cover;" onerror="this.parentElement.innerHTML='<div class=\'bg-secondary text-white d-flex align-items-center justify-content-center\' style=\'height: 200px;\'><i class=\'fas fa-calendar fa-3x\'></i></div>'">
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
