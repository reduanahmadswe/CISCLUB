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
        $sql = "SELECT * FROM users WHERE username = '" . db_escape($username) . "' LIMIT 1";
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

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">
                        <i class="fas fa-sign-in-alt text-primary"></i> Login
                    </h2>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required 
                                   value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                        
                        <div class="text-center">
                            <p class="mb-0">Don't have an account? 
                                <a href="register.php">Register here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
