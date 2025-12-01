<?php
require_once __DIR__ . '/../config/config.php';

if (!is_admin_logged_in()) {
    redirect(ADMIN_URL . '/login.php');
}

$page_title = 'Contact Messages';

// Handle status update
if (isset($_POST['update_status'])) {
    $msg_id = (int)$_POST['msg_id'];
    $status = clean_input($_POST['status']);
    
    $update_query = "UPDATE contact_messages SET status = '" . db_escape($status) . "' WHERE id = $msg_id";
    if (db_query($update_query)) {
        set_message('success', 'Message status updated');
    }
    redirect(ADMIN_URL . '/messages.php');
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if (db_query("DELETE FROM contact_messages WHERE id = $id")) {
        set_message('success', 'Message deleted');
    }
    redirect(ADMIN_URL . '/messages.php');
}

// Fetch messages
$messages_query = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$messages = db_fetch_all(db_query($messages_query));

include __DIR__ . '/includes/header.php';
?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <?php if (count($messages) > 0): ?>
            <?php foreach ($messages as $msg): ?>
                <div class="card mb-3 <?php echo $msg['status'] == 'unread' ? 'border-primary' : ''; ?>">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="card-title">
                                    <?php if ($msg['status'] == 'unread'): ?>
                                        <span class="badge bg-primary">New</span>
                                    <?php endif; ?>
                                    <?php echo htmlspecialchars($msg['subject'] ?: 'No Subject'); ?>
                                </h5>
                                <p class="card-text"><strong>From:</strong> <?php echo htmlspecialchars($msg['name']); ?> 
                                   (<?php echo htmlspecialchars($msg['email']); ?>)</p>
                                <p class="card-text"><?php echo nl2br(htmlspecialchars($msg['message'])); ?></p>
                                <p class="text-muted small">
                                    <i class="fas fa-clock"></i> <?php echo time_ago($msg['created_at']); ?>
                                </p>
                            </div>
                            <div>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="msg_id" value="<?php echo $msg['id']; ?>">
                                    <select name="status" class="form-select form-select-sm mb-2" onchange="this.form.submit()">
                                        <option value="unread" <?php echo $msg['status'] == 'unread' ? 'selected' : ''; ?>>Unread</option>
                                        <option value="read" <?php echo $msg['status'] == 'read' ? 'selected' : ''; ?>>Read</option>
                                        <option value="replied" <?php echo $msg['status'] == 'replied' ? 'selected' : ''; ?>>Replied</option>
                                    </select>
                                    <button type="submit" name="update_status" class="btn btn-sm btn-primary w-100">Update</button>
                                </form>
                                <a href="?delete=<?php echo $msg['id']; ?>" 
                                   class="btn btn-sm btn-danger w-100 mt-2" 
                                   onclick="return confirm('Delete this message?')">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-muted text-center">No messages yet.</p>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
