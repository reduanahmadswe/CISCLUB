<?php
require_once __DIR__ . '/../config/config.php';
$page_title = 'Committee Members';
include __DIR__ . '/../includes/header.php';
?>

<?php

// Fetch committee members
$members_query = "SELECT * FROM committee_members WHERE status = 'active' ORDER BY display_order ASC, created_at ASC";
$members_result = db_query($members_query);
$members = db_fetch_all($members_result);
?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h1 class="display-4 fw-bold">Our Committee</h1>
            <p class="lead text-muted">Meet the dedicated team behind DIU CIS Club</p>
        </div>
    </div>

    <div class="row g-4">
        <?php if (count($members) > 0): ?>
            <?php foreach ($members as $member): ?>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body p-4">
                            <?php if ($member['image']): ?>
                                <img src="<?php echo htmlspecialchars($member['image']); ?>" 
                                     class="rounded-circle mb-3" 
                                     alt="<?php echo htmlspecialchars($member['full_name']); ?>"
                                     style="width: 120px; height: 120px; object-fit: cover;"
                                     onerror="this.parentElement.innerHTML='<div class=\'rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3\' style=\'width: 120px; height: 120px;\'><i class=\'fas fa-user fa-3x\'></i></div>'">
                            <?php else: ?>
                                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center mb-3" 
                                     style="width: 120px; height: 120px;">
                                    <i class="fas fa-user fa-3x"></i>
                                </div>
                            <?php endif; ?>
                            
                            <h5 class="fw-bold mb-1"><?php echo htmlspecialchars($member['full_name']); ?></h5>
                            <p class="text-primary mb-3"><?php echo htmlspecialchars($member['position']); ?></p>
                            
                            <?php if ($member['email']): ?>
                                <p class="small mb-2">
                                    <i class="fas fa-envelope"></i> <?php echo htmlspecialchars($member['email']); ?>
                                </p>
                            <?php endif; ?>
                            
                            <div class="social-links">
                                <?php if ($member['facebook']): ?>
                                    <a href="<?php echo htmlspecialchars($member['facebook']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if ($member['linkedin']): ?>
                                    <a href="<?php echo htmlspecialchars($member['linkedin']); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-2x mb-3"></i>
                    <h5>Committee information will be updated soon</h5>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
