<?php
require_once __DIR__ . '/../config/config.php';
$page_title = 'About Us';
include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">

    <!-- About Hero -->
    <div class="row mb-5">
        <div class="col-md-12 text-center">
            <h1 class="display-4 fw-bold mb-3">About DIU CIS Club</h1>
            <p class="lead text-muted">Computing & Information System Club - Building Future Tech Leaders</p>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="row mb-5">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="text-primary mb-3">
                        <i class="fas fa-bullseye fa-3x"></i>
                    </div>
                    <h3 class="card-title">Our Mission</h3>
                    <p class="card-text">To create a platform where students can enhance their technical skills, collaborate on innovative projects, and prepare for successful careers in computing and information systems.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="text-success mb-3">
                        <i class="fas fa-eye fa-3x"></i>
                    </div>
                    <h3 class="card-title">Our Vision</h3>
                    <p class="card-text">To be the leading student organization in fostering innovation, technical excellence, and professional development in the field of computing and information systems.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- What We Do -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h2 class="fw-bold mb-4 text-center">What We Do</h2>
        </div>
        <div class="col-md-4 mb-3">
            <div class="text-center p-3">
                <i class="fas fa-laptop-code fa-3x text-primary mb-3"></i>
                <h5>Technical Workshops</h5>
                <p class="text-muted">Regular workshops on programming, web development, AI, and emerging technologies</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="text-center p-3">
                <i class="fas fa-trophy fa-3x text-warning mb-3"></i>
                <h5>Competitions</h5>
                <p class="text-muted">Organize programming contests, hackathons, and tech challenges</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="text-center p-3">
                <i class="fas fa-users fa-3x text-success mb-3"></i>
                <h5>Networking Events</h5>
                <p class="text-muted">Connect students with industry professionals and alumni</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="text-center p-3">
                <i class="fas fa-chalkboard-teacher fa-3x text-info mb-3"></i>
                <h5>Seminars & Talks</h5>
                <p class="text-muted">Guest lectures from industry experts and successful entrepreneurs</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="text-center p-3">
                <i class="fas fa-project-diagram fa-3x text-danger mb-3"></i>
                <h5>Project Collaboration</h5>
                <p class="text-muted">Team projects and real-world problem-solving initiatives</p>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="text-center p-3">
                <i class="fas fa-certificate fa-3x text-secondary mb-3"></i>
                <h5>Skill Development</h5>
                <p class="text-muted">Certification courses and career development programs</p>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row bg-primary text-white rounded p-5 mb-5">
        <div class="col-md-3 text-center mb-3">
            <h2 class="display-4 fw-bold">500+</h2>
            <p class="lead">Active Members</p>
        </div>
        <div class="col-md-3 text-center mb-3">
            <h2 class="display-4 fw-bold">50+</h2>
            <p class="lead">Events Organized</p>
        </div>
        <div class="col-md-3 text-center mb-3">
            <h2 class="display-4 fw-bold">100+</h2>
            <p class="lead">Workshops Conducted</p>
        </div>
        <div class="col-md-3 text-center mb-3">
            <h2 class="display-4 fw-bold">20+</h2>
            <p class="lead">Industry Partners</p>
        </div>
    </div>

    <!-- Join CTA -->
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="fw-bold mb-3">Ready to Join Us?</h2>
            <p class="lead mb-4">Become a part of the most dynamic tech community at DIU</p>
            <?php if (!is_logged_in()): ?>
                <a href="<?php echo SITE_URL; ?>/auth/register.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-user-plus"></i> Register Now
                </a>
            <?php else: ?>
                <a href="<?php echo SITE_URL; ?>/pages/events.php" class="btn btn-primary btn-lg">
                    <i class="fas fa-calendar"></i> Explore Events
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
