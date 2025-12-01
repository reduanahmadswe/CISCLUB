<?php
require_once __DIR__ . '/../config/config.php';

if (!is_admin_logged_in()) {
    redirect(ADMIN_URL . '/login.php');
}

$page_title = 'Event Bookings';

// Handle status update
if (isset($_POST['update_status'])) {
    $booking_id = (int)$_POST['booking_id'];
    $status = clean_input($_POST['status']);
    
    $update_query = "UPDATE event_registrations SET status = '" . db_escape($status) . "' WHERE id = $booking_id";
    if (db_query($update_query)) {
        set_message('success', 'Booking status updated successfully');
    } else {
        set_message('danger', 'Failed to update status');
    }
    redirect(ADMIN_URL . '/bookings.php');
}

// Fetch all bookings
$bookings_query = "SELECT er.*, u.full_name, u.email, u.phone, e.event_name, e.date_start 
                   FROM event_registrations er 
                   JOIN users u ON er.user_id = u.id 
                   JOIN events e ON er.event_id = e.id 
                   ORDER BY er.registration_date DESC";
$bookings = db_fetch_all(db_query($bookings_query));

include __DIR__ . '/includes/header.php';
?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Event</th>
                        <th>Contact</th>
                        <th>Event Date</th>
                        <th>Registered</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo $booking['id']; ?></td>
                            <td><?php echo htmlspecialchars($booking['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($booking['event_name']); ?></td>
                            <td>
                                <small>
                                    <?php echo htmlspecialchars($booking['email']); ?><br>
                                    <?php echo htmlspecialchars($booking['phone'] ?? 'N/A'); ?>
                                </small>
                            </td>
                            <td><?php echo format_date($booking['date_start']); ?></td>
                            <td><?php echo time_ago($booking['registration_date']); ?></td>
                            <td>
                                <span class="badge bg-<?php 
                                    echo $booking['status'] == 'confirmed' ? 'success' : 
                                        ($booking['status'] == 'pending' ? 'warning' : 'danger'); 
                                ?>"><?php echo ucfirst($booking['status']); ?></span>
                            </td>
                            <td>
                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="booking_id" value="<?php echo $booking['id']; ?>">
                                    <select name="status" class="form-select form-select-sm d-inline w-auto" onchange="this.form.submit()">
                                        <option value="pending" <?php echo $booking['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="confirmed" <?php echo $booking['status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                        <option value="cancelled" <?php echo $booking['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                    <button type="submit" name="update_status" class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
