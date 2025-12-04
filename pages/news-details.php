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
include __DIR__ . '/../includes/header.php';
?>

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
