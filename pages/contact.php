<?php
require_once __DIR__ . '/../config/config.php';
$page_title = 'Contact Us';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = clean_input($_POST['name']);
    $email = clean_input($_POST['email']);
    $subject = clean_input($_POST['subject']);
    $message = clean_input($_POST['message']);
    
    if (empty($name) || empty($email) || empty($message)) {
        $error = 'Please fill in all required fields';
    } else {
        $insert_query = "INSERT INTO contact_messages (name, email, subject, message) 
                        VALUES ('" . db_escape($name) . "', 
                                '" . db_escape($email) . "', 
                                '" . db_escape($subject) . "', 
                                '" . db_escape($message) . "')";
        
        if (db_query($insert_query)) {
            $success = 'Thank you for contacting us! We will get back to you soon.';
            $_POST = array();
        } else {
            $error = 'Failed to send message. Please try again.';
        }
    }
}

include __DIR__ . '/../includes/header.php';
?>

<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h1 class="display-4 fw-bold">Contact Us</h1>
            <p class="lead text-muted">Get in touch with DIU CIS Club</p>
        </div>
    </div>

    <div class="row">
        <!-- Contact Information -->
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Contact Information</h4>
                    
                    <div class="mb-4">
                        <i class="fas fa-map-marker-alt text-primary fa-2x mb-2"></i>
                        <h6 class="fw-bold">Address</h6>
                        <p class="text-muted">Daffodil International University<br>
                        Ashulia, Savar, Dhaka-1207<br>
                        Bangladesh</p>
                    </div>
                    
                    <div class="mb-4">
                        <i class="fas fa-envelope text-primary fa-2x mb-2"></i>
                        <h6 class="fw-bold">Email</h6>
                        <p class="text-muted">cisclub@diu.edu.bd</p>
                    </div>
                    
                    <div class="mb-4">
                        <i class="fas fa-phone text-primary fa-2x mb-2"></i>
                        <h6 class="fw-bold">Phone</h6>
                        <p class="text-muted">+880 123 456 789</p>
                    </div>
                    
                    <div>
                        <h6 class="fw-bold mb-3">Follow Us</h6>
                        <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="btn btn-outline-primary btn-sm me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn btn-outline-primary btn-sm"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-md-8 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h4 class="fw-bold mb-4">Send us a Message</h4>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <?php if ($success): ?>
                        <div class="alert alert-success"><?php echo $success; ?></div>
                    <?php endif; ?>
                    
                    <form method="POST" action="">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" required 
                                       value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" required 
                                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" 
                                   value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Message <span class="text-danger">*</span></label>
                            <textarea name="message" class="form-control" rows="6" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>
