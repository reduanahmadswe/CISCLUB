<?php
require_once __DIR__ . '/../config/config.php';

// If already logged in, redirect to dashboard
if (is_admin_logged_in()) {
    redirect(ADMIN_URL . '/index.php');
}

$error = '';
$debug_info = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    error_log("=== ADMIN LOGIN ATTEMPT ===");
    
    $username = clean_input($_POST['username']);
    $password = $_POST['password'];
    
    error_log("Input Username: " . $username);
    error_log("Input Password: " . $password);
    
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password';
        error_log("ERROR: Empty username or password");
    } else {
        $sql = "SELECT * FROM admin_users WHERE username = '" . db_escape($username) . "' LIMIT 1";
        error_log("SQL Query: " . $sql);
        
        $result = db_query($sql);
        
        if (!$result) {
            $error = 'Database error: ' . mysqli_error($GLOBALS['conn']);
            error_log("DATABASE ERROR: " . mysqli_error($GLOBALS['conn']));
        } elseif (mysqli_num_rows($result) > 0) {
            $admin = db_fetch($result);
            error_log("User found in database");
            error_log("Stored password from DB: [" . $admin['password'] . "]");
            error_log("Input password: [" . $password . "]");
            
            // Debug info
            $debug_info = 'Found user ID: ' . $admin['id'] . ' | DB Pass: [' . $admin['password'] . '] | Input Pass: [' . $password . ']';
            
            // Check password - support both plain and hashed passwords
            $input_password = trim($password);
            $stored_password = trim($admin['password']);
            
            $plain_match = ($input_password === $stored_password);
            $hash_match = password_verify($input_password, $stored_password);
            
            error_log("Plain text match: " . ($plain_match ? 'YES' : 'NO'));
            error_log("Hash match: " . ($hash_match ? 'YES' : 'NO'));
            
            if ($plain_match || $hash_match) {
                error_log("LOGIN SUCCESS - Setting session");
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_name'] = $admin['full_name'];
                $_SESSION['admin_username'] = $admin['username'];
                
                error_log("Session set - Redirecting to: " . ADMIN_URL . '/index.php');
                redirect(ADMIN_URL . '/index.php');
            } else {
                $error = 'Invalid username or password. Password mismatch.';
                $debug_info .= ' | Match: FAILED';
                error_log("LOGIN FAILED - Password mismatch");
            }
        } else {
            $error = 'Invalid username or password. User not found in database.';
            error_log("LOGIN FAILED - No user found with username: " . $username);
        }
    }
    
    error_log("=== END LOGIN ATTEMPT ===\n");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Admin Login - DIU CIS Club</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #1e293b 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(139, 92, 246, 0.1) 0%, transparent 50%);
            animation: float 20s infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        .admin-login-card {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            animation: slideIn 0.5s ease;
            position: relative;
            z-index: 1;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .admin-header {
            background: linear-gradient(135deg, #1e293b, #334155);
            padding: 2.5rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .admin-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6, #ec4899);
        }
        
        .admin-header i {
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
            color: #6366f1;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .admin-body {
            padding: 2.5rem;
        }
        
        .form-control {
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.15);
            transform: translateY(-2px);
        }
        
        .form-label {
            font-weight: 600;
            color: #334155;
            margin-bottom: 0.5rem;
        }
        
        .btn-admin {
            background: linear-gradient(135deg, #1e293b, #334155);
            border: none;
            padding: 1rem;
            font-weight: 600;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            color: white;
        }
        
        .btn-admin:hover {
            background: linear-gradient(135deg, #334155, #1e293b);
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(30, 41, 59, 0.4);
            color: white;
        }
        
        .back-link {
            text-align: center;
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 0 0 1.5rem 1.5rem;
            margin: -1rem -2.5rem 0;
        }
        
        .back-link a {
            color: #1e293b;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .back-link a:hover {
            color: #6366f1;
            transform: translateX(-5px);
            display: inline-block;
        }
        
        @media (max-width: 576px) {
            .admin-body {
                padding: 1.5rem;
            }
            
            .admin-header {
                padding: 1.5rem;
            }
            
            .admin-header i {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="admin-login-card">
                    <div class="admin-header">
                        <i class="fas fa-shield-alt"></i>
                        <h2 class="mb-0">Admin Portal</h2>
                        <p class="mb-0 mt-2 opacity-75">DIU CIS Club Management</p>
                    </div>
                    
                    <div class="admin-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($debug_info): ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <small><?php echo htmlspecialchars($debug_info); ?></small>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="" class="needs-validation" novalidate>
                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="fas fa-user-shield me-2"></i>Username
                                </label>
                                <input type="text" name="username" class="form-control" 
                                       placeholder="Enter admin username"
                                       required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="fas fa-key me-2"></i>Password
                                </label>
                                <input type="password" name="password" class="form-control" 
                                       placeholder="Enter admin password"
                                       required>
                            </div>
                            
                            <button type="submit" class="btn btn-admin w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Access Admin Panel
                            </button>
                        </form>
                        
                        <div class="back-link">
                            <a href="<?php echo SITE_URL; ?>">
                                <i class="fas fa-arrow-left me-2"></i>Back to Main Site
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
