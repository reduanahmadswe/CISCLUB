<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>Admin Panel - DIU CIS Club</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            padding: 0;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1000;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }
        
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: #0f172a;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: #6366f1;
            border-radius: 3px;
        }
        
        .sidebar-header {
            padding: 1.5rem;
            background: rgba(99, 102, 241, 0.1);
            border-bottom: 2px solid #6366f1;
            position: sticky;
            top: 0;
            z-index: 10;
            backdrop-filter: blur(10px);
        }
        
        .sidebar-brand {
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .sidebar-brand i {
            font-size: 1.5rem;
            color: #6366f1;
            animation: pulse 2s infinite;
        }
        
        .sidebar-nav {
            padding: 1rem 0;
        }
        
        .sidebar-nav .nav-item {
            margin: 0.25rem 0.75rem;
        }
        
        .sidebar-nav .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 0.875rem 1rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.3s ease;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar-nav .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background: #6366f1;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .sidebar-nav .nav-link:hover::before,
        .sidebar-nav .nav-link.active::before {
            transform: scaleY(1);
        }
        
        .sidebar-nav .nav-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .sidebar-nav .nav-link:hover {
            color: white;
            background: rgba(99, 102, 241, 0.2);
            transform: translateX(5px);
        }
        
        .sidebar-nav .nav-link.active {
            color: white;
            background: rgba(99, 102, 241, 0.3);
            font-weight: 600;
        }
        
        .sidebar-footer {
            position: sticky;
            bottom: 0;
            padding: 1rem;
            background: rgba(15, 23, 42, 0.95);
            border-top: 1px solid rgba(99, 102, 241, 0.2);
            backdrop-filter: blur(10px);
        }
        
        .sidebar-footer .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .sidebar-footer .nav-link:hover {
            color: white;
            background: rgba(239, 68, 68, 0.2);
        }
        
        /* Main Content */
        .main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        
        /* Top Bar */
        .top-bar {
            background: white;
            padding: 1rem 2rem;
            border-radius: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .top-bar .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .top-bar .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }
        
        /* Mobile Toggle */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 1001;
            background: #6366f1;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 0.5rem;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 1rem;
            }
            
            .sidebar-toggle {
                display: block;
            }
            
            .top-bar {
                padding: 0.75rem 1rem;
                margin-top: 3.5rem;
            }
        }
        
        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.15);
        }
        .btn {
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }
        .table {
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .table thead {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
        }
        .table tbody tr {
            transition: all 0.3s ease;
        }
        .table tbody tr:hover {
            background: rgba(99, 102, 241, 0.05);
            transform: scale(1.01);
        }
        .modal-content {
            border-radius: 1rem;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        .modal-header {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            border-radius: 1rem 1rem 0 0;
        }
        .form-control:focus, .form-select:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
        }
    </style>
</head>
<body>
    <!-- Sidebar Toggle Button (Mobile) -->
    <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="<?php echo ADMIN_URL; ?>/index.php" class="sidebar-brand">
                <i class="fas fa-shield-alt"></i>
                <span>Admin Panel</span>
            </a>
        </div>
        
        <ul class="sidebar-nav nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" 
                   href="<?php echo ADMIN_URL; ?>/index.php">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'categories.php' ? 'active' : ''; ?>" 
                   href="<?php echo ADMIN_URL; ?>/categories.php">
                    <i class="fas fa-tags"></i>
                    <span>Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'events.php' ? 'active' : ''; ?>" 
                   href="<?php echo ADMIN_URL; ?>/events.php">
                    <i class="fas fa-calendar"></i>
                    <span>Events</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'news.php' ? 'active' : ''; ?>" 
                   href="<?php echo ADMIN_URL; ?>/news.php">
                    <i class="fas fa-newspaper"></i>
                    <span>News</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'committee.php' ? 'active' : ''; ?>" 
                   href="<?php echo ADMIN_URL; ?>/committee.php">
                    <i class="fas fa-users"></i>
                    <span>Committee</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'sponsors.php' ? 'active' : ''; ?>" 
                   href="<?php echo ADMIN_URL; ?>/sponsors.php">
                    <i class="fas fa-handshake"></i>
                    <span>Sponsors</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : ''; ?>" 
                   href="<?php echo ADMIN_URL; ?>/users.php">
                    <i class="fas fa-user-friends"></i>
                    <span>Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo SITE_URL; ?>" target="_blank">
                    <i class="fas fa-external-link-alt"></i>
                    <span>View Site</span>
                </a>
            </li>
        </ul>
        
        <div class="sidebar-footer">
            <div class="text-white mb-2" style="padding: 0 1rem; font-size: 0.875rem;">
                <i class="fas fa-user-circle me-2"></i>
                <?php echo $_SESSION['admin_name'] ?? 'Admin'; ?>
            </div>
            <a class="nav-link" href="<?php echo ADMIN_URL; ?>/logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="top-bar">
            <div>
                <h1 class="h3 mb-0"><?php echo $page_title ?? 'Dashboard'; ?></h1>
            </div>
            <div class="user-info">
                <div class="user-avatar">
                    <?php echo strtoupper(substr($_SESSION['admin_name'] ?? 'A', 0, 1)); ?>
                </div>
                <span class="fw-semibold"><?php echo $_SESSION['admin_name'] ?? 'Admin'; ?></span>
            </div>
        </div>

                <?php
                $message = get_message();
                if ($message):
                ?>
                <div class="alert alert-<?php echo $message['type']; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message['text']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>
