<?php
require_once __DIR__ . '/../config/config.php';

// If already logged in, redirect to dashboard
if (is_logged_in()) {
    redirect(SITE_URL . '/pages/dashboard.php');
}

$page_title = 'Login';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = clean_input($_POST['username']);
    $password = $_POST['password'];
    
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password';
    } else {
        $sql = "SELECT * FROM users WHERE username = '" . db_escape($username) . "' OR email = '" . db_escape($username) . "' LIMIT 1";
        $result = db_query($sql);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $user = db_fetch($result);
            
            if (password_verify($password, $user['password'])) {
                if ($user['status'] == 'active') {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['full_name'];
                    $_SESSION['username'] = $user['username'];
                    
                    set_message('success', 'Welcome back, ' . $user['full_name'] . '!');
                    redirect(SITE_URL . '/pages/dashboard.php');
                } else {
                    $error = 'Your account is pending approval or inactive';
                }
            } else {
                $error = 'Invalid username or password';
            }
        } else {
            $error = 'Invalid username or password';
        }
    }
}

include __DIR__ . '/../includes/header.php';
?>

<style>
    .login-container {
        min-height: calc(100vh - var(--navbar-height) - var(--footer-height));
        display: flex;
        align-items: center;
        background: white;
        padding: 2rem 0;
    }
    
    .login-card {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        animation: slideIn 0.5s ease;
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
    
    .login-header {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        padding: 2rem;
        text-align: center;
        color: white;
    }
    
    .login-header i {
        font-size: 3rem;
        margin-bottom: 1rem;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    .login-body {
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
    
    .btn-login {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        padding: 1rem;
        font-weight: 600;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }
    
    .btn-login:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
    }
    
    .register-link {
        text-align: center;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 0 0 1.5rem 1.5rem;
        margin: -1rem -2.5rem 0;
    }
    
    .register-link a {
        color: #6366f1;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .register-link a:hover {
        color: #8b5cf6;
        transform: translateX(5px);
        display: inline-block;
    }
    
    @media (max-width: 576px) {
        .login-container {
            padding: 1rem;
        }
        
        .login-body {
            padding: 1.5rem;
        }
        
        .login-header {
            padding: 1.5rem;
        }
        
        .login-header i {
            font-size: 2.5rem;
        }
    }
</style>

<div class="login-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="login-card">
                    <div class="login-header">
                        <i class="fas fa-sign-in-alt"></i>
                        <h2 class="mb-0">Welcome Back</h2>
                        <p class="mb-0 mt-2 opacity-75">Login to your account</p>
                    </div>
                    
                    <div class="login-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="" class="needs-validation" novalidate>
                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="fas fa-user me-2"></i>Username or Email
                                </label>
                                <input type="text" name="username" class="form-control" 
                                       placeholder="Enter your username or email"
                                       required 
                                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <input type="password" name="password" class="form-control" 
                                       placeholder="Enter your password"
                                       required>
                            </div>
                            
                            <button type="submit" class="btn btn-login btn-primary w-100">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </form>
                        
                        <div class="register-link">
                            <p class="mb-0 text-muted">
                                Don't have an account? 
                                <a href="register.php">
                                    Register here <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </p>
                        </div>
                    </div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
