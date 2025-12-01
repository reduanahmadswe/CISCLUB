<?php
require_once __DIR__ . '/../config/config.php';

if (!is_admin_logged_in()) {
    redirect(ADMIN_URL . '/login.php');
}

$page_title = 'Users';

// Handle status update
if (isset($_POST['update_status'])) {
    $user_id = (int)$_POST['user_id'];
    $status = clean_input($_POST['status']);
    
    $update_query = "UPDATE users SET status = '" . db_escape($status) . "' WHERE id = $user_id";
    if (db_query($update_query)) {
        set_message('success', 'User status updated successfully');
    } else {
        set_message('danger', 'Failed to update status');
    }
    redirect(ADMIN_URL . '/users.php');
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $delete_query = "DELETE FROM users WHERE id = $id";
    if (db_query($delete_query)) {
        set_message('success', 'User deleted successfully');
    } else {
        set_message('danger', 'Failed to delete user');
    }
    redirect(ADMIN_URL . '/users.php');
}

// Fetch all users
$users_query = "SELECT * FROM users ORDER BY registration_date DESC";
$users = db_fetch_all(db_query($users_query));

include __DIR__ . '/includes/header.php';
?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Student ID</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['student_id'] ?? 'N/A'); ?></td>
                            <td><?php echo htmlspecialchars($user['phone'] ?? 'N/A'); ?></td>
                            <td>
                                <span class="badge bg-<?php 
                                    echo $user['status'] == 'active' ? 'success' : 
                                        ($user['status'] == 'pending' ? 'warning' : 'secondary'); 
                                ?>"><?php echo ucfirst($user['status']); ?></span>
                            </td>
                            <td><?php echo format_date($user['registration_date']); ?></td>
                            <td>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <select name="status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                                        <option value="pending" <?php echo $user['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="active" <?php echo $user['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                        <option value="inactive" <?php echo $user['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                    </select>
                                    <button type="submit" name="update_status" class="btn btn-sm btn-primary">Update</button>
                                </form>
                                <a href="?delete=<?php echo $user['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
