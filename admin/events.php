<?php
require_once __DIR__ . '/../config/config.php';

if (!is_admin_logged_in()) {
    redirect(ADMIN_URL . '/login.php');
}

$page_title = 'Manage Events';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $sql = "DELETE FROM events WHERE id = $id";
    if (db_query($sql)) {
        set_message('success', 'Event deleted successfully');
    } else {
        set_message('danger', 'Failed to delete event');
    }
    redirect(ADMIN_URL . '/events.php');
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $event_name = clean_input($_POST['event_name']);
    $description = clean_input($_POST['description']);
    $category_id = (int)$_POST['category_id'];
    $date_start = $_POST['date_start'];
    $date_end = $_POST['date_end'];
    $time_start = $_POST['time_start'];
    $location = clean_input($_POST['location']);
    $image = clean_input($_POST['image']);
    $max_participants = (int)$_POST['max_participants'];
    $status = $_POST['status'];
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update
        $id = (int)$_POST['id'];
        $sql = "UPDATE events SET 
                event_name = '" . db_escape($event_name) . "',
                description = '" . db_escape($description) . "',
                category_id = $category_id,
                date_start = '$date_start',
                date_end = '$date_end',
                time_start = '$time_start',
                location = '" . db_escape($location) . "',
                image = '" . db_escape($image) . "',
                max_participants = $max_participants,
                status = '$status'
                WHERE id = $id";
        
        if (db_query($sql)) {
            set_message('success', 'Event updated successfully');
        } else {
            set_message('danger', 'Failed to update event');
        }
    } else {
        // Insert
        $sql = "INSERT INTO events (event_name, description, category_id, date_start, date_end, time_start, location, image, max_participants, status) 
                VALUES ('" . db_escape($event_name) . "', '" . db_escape($description) . "', $category_id, '$date_start', '$date_end', '$time_start', '" . db_escape($location) . "', '" . db_escape($image) . "', $max_participants, '$status')";
        
        if (db_query($sql)) {
            set_message('success', 'Event created successfully');
        } else {
            set_message('danger', 'Failed to create event');
        }
    }
    redirect(ADMIN_URL . '/events.php');
}

// Fetch all events
$events_query = "SELECT e.*, c.category_name FROM events e LEFT JOIN categories c ON e.category_id = c.id ORDER BY e.date_start DESC";
$events_result = db_query($events_query);
$events = db_fetch_all($events_result);

// Fetch categories
$categories_query = "SELECT * FROM categories WHERE status = 'active'";
$categories_result = db_query($categories_query);
$categories = db_fetch_all($categories_result);

// Get event for editing
$edit_event = null;
if (isset($_GET['edit'])) {
    $edit_id = (int)$_GET['edit'];
    $edit_query = "SELECT * FROM events WHERE id = $edit_id";
    $edit_result = db_query($edit_query);
    $edit_event = db_fetch($edit_result);
}

include __DIR__ . '/includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-calendar-alt"></i> Events Management</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventModal" onclick="clearForm()">
        <i class="fas fa-plus"></i> Add Event
    </button>
</div>

<?php if (count($events) > 0): ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Event Name</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?php echo $event['id']; ?></td>
                        <td>
                            <?php if ($event['image']): ?>
                                <img src="<?php echo htmlspecialchars($event['image']); ?>" alt="Event" style="width: 50px; height: 50px; object-fit: cover;">
                            <?php else: ?>
                                <i class="fas fa-image fa-2x text-muted"></i>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($event['event_name']); ?></td>
                        <td><span class="badge bg-info"><?php echo htmlspecialchars($event['category_name']); ?></span></td>
                        <td><?php echo format_date($event['date_start']); ?></td>
                        <td><?php echo htmlspecialchars($event['location']); ?></td>
                        <td>
                            <span class="badge bg-<?php 
                                echo $event['status'] == 'upcoming' ? 'primary' : 
                                    ($event['status'] == 'ongoing' ? 'success' : 
                                    ($event['status'] == 'completed' ? 'secondary' : 'danger')); 
                            ?>">
                                <?php echo ucfirst($event['status']); ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick='editEvent(<?php echo json_encode($event); ?>)'>
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="?delete=<?php echo $event['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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
<?php else: ?>
<div class="alert alert-info">No events found. Create your first event!</div>
<?php endif; ?>

<!-- Event Modal -->
<div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="event_id">
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Event Name *</label>
                            <input type="text" name="event_name" id="event_name" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Category *</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['category_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description *</label>
                        <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Start Date *</label>
                            <input type="date" name="date_start" id="date_start" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" name="date_end" id="date_end" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Time</label>
                            <input type="time" name="time_start" id="time_start" class="form-control">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Location *</label>
                        <input type="text" name="location" id="location" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Image URL</label>
                        <input type="url" name="image" id="image" class="form-control" placeholder="https://example.com/image.jpg">
                        <small class="text-muted">Paste image URL from online source</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Max Participants</label>
                            <input type="number" name="max_participants" id="max_participants" class="form-control" value="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status *</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="upcoming">Upcoming</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function clearForm() {
    document.getElementById('modalTitle').textContent = 'Add Event';
    document.getElementById('event_id').value = '';
    document.getElementById('event_name').value = '';
    document.getElementById('description').value = '';
    document.getElementById('category_id').value = '';
    document.getElementById('date_start').value = '';
    document.getElementById('date_end').value = '';
    document.getElementById('time_start').value = '';
    document.getElementById('location').value = '';
    document.getElementById('image').value = '';
    document.getElementById('max_participants').value = '0';
    document.getElementById('status').value = 'upcoming';
}

function editEvent(event) {
    document.getElementById('modalTitle').textContent = 'Edit Event';
    document.getElementById('event_id').value = event.id;
    document.getElementById('event_name').value = event.event_name;
    document.getElementById('description').value = event.description;
    document.getElementById('category_id').value = event.category_id;
    document.getElementById('date_start').value = event.date_start;
    document.getElementById('date_end').value = event.date_end || '';
    document.getElementById('time_start').value = event.time_start || '';
    document.getElementById('location').value = event.location;
    document.getElementById('image').value = event.image || '';
    document.getElementById('max_participants').value = event.max_participants;
    document.getElementById('status').value = event.status;
    
    new bootstrap.Modal(document.getElementById('eventModal')).show();
}

<?php if ($edit_event): ?>
editEvent(<?php echo json_encode($edit_event); ?>);
<?php endif; ?>
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
