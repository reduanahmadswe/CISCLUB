<?php
require_once __DIR__ . '/../config/config.php';
$page_title = 'News';
include __DIR__ . '/../includes/header.php';
?>

<?php

// Fetch all news
$news_query = "SELECT * FROM news WHERE status = 'published' ORDER BY created_at DESC";
$news_result = db_query($news_query);
$news = db_fetch_all($news_result);
?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h1 class="display-4 fw-bold">Club News</h1>
            <p class="lead text-muted">Stay updated with latest announcements and activities</p>
        </div>
    </div>

    <div class="row g-4">
        <?php if (count($news) > 0): ?>
            <?php foreach ($news as $item): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body">
                            <p class="text-muted small">
                                <i class="fas fa-clock"></i> <?php echo time_ago($item['created_at']); ?>
                            </p>
                            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($item['title']); ?></h5>
                            <p class="card-text text-muted">
                                <?php echo substr(htmlspecialchars($item['description']), 0, 150); ?>...
                            </p>
                            <a href="news-details.php?id=<?php echo $item['id']; ?>" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-arrow-right"></i> Read More
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h5>No news available</h5>
                    <p>Check back later for updates.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
