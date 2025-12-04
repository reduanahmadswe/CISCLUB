<?php
require_once __DIR__ . '/../config/config.php';

// If already logged in, redirect to dashboard
if (is_logged_in()) {
    redirect(SITE_URL . '/pages/dashboard.php');
}

$page_title = 'Register';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = clean_input($_POST['full_name']);
    $email = clean_input($_POST['email']);
    $username = clean_input($_POST['username']);
    $student_id = clean_input($_POST['student_id']);
    $phone = clean_input($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation
    if (empty($full_name) || empty($email) || empty($username) || empty($password)) {
        $error = 'Please fill in all required fields';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters';
    } else {
        // Check if username exists
        $check_sql = "SELECT id FROM users WHERE username = '" . db_escape($username) . "' OR email = '" . db_escape($email) . "'";
        $check_result = db_query($check_sql);
        
        if (mysqli_num_rows($check_result) > 0) {
            $error = 'Username or email already exists';
        } else {
            // Insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_sql = "INSERT INTO users (full_name, email, username, student_id, phone, password, status) 
                          VALUES ('" . db_escape($full_name) . "', 
                                  '" . db_escape($email) . "', 
                                  '" . db_escape($username) . "', 
                                  '" . db_escape($student_id) . "', 
                                  '" . db_escape($phone) . "', 
                                  '" . db_escape($hashed_password) . "', 
                                  'active')";
            
            if (db_query($insert_sql)) {
                $success = 'Registration successful! You can now login.';
                $_POST = array(); // Clear form
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}

include __DIR__ . '/../includes/header.php';
?>

<style>
    .register-container {
        min-height: calc(100vh - var(--navbar-height) - var(--footer-height));
        display: flex;
        align-items: center;
        background: white;
        padding: 2rem 0;
    }
    
    .register-card {
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
    
    .register-header {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        padding: 2rem;
        text-align: center;
        color: white;
    }
    
    .register-header i {
        font-size: 3rem;
        margin-bottom: 1rem;
        animation: bounce 2s infinite;
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    .register-body {
        padding: 2.5rem;
        max-height: 70vh;
        overflow-y: auto;
    }
    
    .register-body::-webkit-scrollbar {
        width: 8px;
    }
    
    .register-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .register-body::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #6366f1, #8b5cf6);
        border-radius: 10px;
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
    
    .btn-register {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        padding: 1rem;
        font-weight: 600;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }
    
    .btn-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
    }
    
    .login-link {
        text-align: center;
        padding: 1.5rem;
        background: #f8fafc;
        border-radius: 0 0 1.5rem 1.5rem;
        margin: -1rem -2.5rem 0;
    }
    
    .login-link a {
        color: #6366f1;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .login-link a:hover {
        color: #8b5cf6;
        transform: translateX(5px);
        display: inline-block;
    }
    
    @media (max-width: 576px) {
        .register-container {
            padding: 1rem;
        }
        
        .register-body {
            padding: 1.5rem;
            max-height: 60vh;
        }
        
        .register-header {
            padding: 1.5rem;
        }
        
        .register-header i {
            font-size: 2.5rem;
        }
    }
</style>

<div class="register-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                <div class="register-card">
                    <div class="register-header">
                        <i class="fas fa-user-plus"></i>
                        <h2 class="mb-0">Create Account</h2>
                        <p class="mb-0 mt-2 opacity-75">Join DIU CIS Club today</p>
                    </div>
                    
                    <div class="register-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($success): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i><?php echo $success; ?>
                                <a href="login.php" class="alert-link ms-2">Click here to login</a>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                    
                        <form method="POST" action="" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-user me-2"></i>Full Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="full_name" class="form-control" 
                                       placeholder="Enter your full name"
                                       required 
                                       value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : ''; ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-envelope me-2"></i>Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" name="email" class="form-control" 
                                       placeholder="your.email@diu.edu.bd"
                                       required 
                                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-user-circle me-2"></i>Username <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="username" class="form-control" 
                                       placeholder="Choose a username"
                                       required 
                                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-id-card me-2"></i>Student ID
                                    </label>
                                    <input type="text" name="student_id" class="form-control" 
                                           placeholder="e.g., 123-45-678"
                                           value="<?php echo isset($_POST['student_id']) ? htmlspecialchars($_POST['student_id']) : ''; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="fas fa-phone me-2"></i>Phone
                                    </label>
                                    <input type="text" name="phone" class="form-control" 
                                           placeholder="+880 123 456 789"
                                           value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password" class="form-control" 
                                       placeholder="Create a strong password"
                                       required>
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>Minimum 6 characters
                                </small>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label">
                                    <i class="fas fa-lock me-2"></i>Confirm Password <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="confirm_password" class="form-control" 
                                       placeholder="Re-enter your password"
                                       required>
                            </div>
                            
                            <button type="submit" class="btn btn-register btn-primary w-100">
                                <i class="fas fa-user-plus me-2"></i>Create Account
                            </button>
                        </form>
                        
                        <div class="login-link">
                            <p class="mb-0 text-muted">
                                Already have an account? 
                                <a href="login.php">
                                    Login here <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
