<?php
require_once __DIR__ . '/../config/config.php';

if (!is_admin_logged_in()) {
    redirect(ADMIN_URL . '/login.php');
}

$page_title = 'Manage Committee';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $sql = "DELETE FROM committee_members WHERE id = $id";
    if (db_query($sql)) {
        set_message('success', 'Committee member deleted successfully');
    } else {
        set_message('danger', 'Failed to delete committee member');
    }
    redirect(ADMIN_URL . '/committee.php');
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = clean_input($_POST['full_name']);
    $position = clean_input($_POST['position']);
    $image = clean_input($_POST['image']);
    $email = clean_input($_POST['email']);
    $facebook = clean_input($_POST['facebook']);
    $linkedin = clean_input($_POST['linkedin']);
    $phone = clean_input($_POST['phone']);
    $display_order = (int)$_POST['display_order'];
    $status = $_POST['status'];
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update
        $id = (int)$_POST['id'];
        $sql = "UPDATE committee_members SET 
                full_name = '" . db_escape($full_name) . "',
                position = '" . db_escape($position) . "',
                image = '" . db_escape($image) . "',
                email = '" . db_escape($email) . "',
                facebook = '" . db_escape($facebook) . "',
                linkedin = '" . db_escape($linkedin) . "',
                phone = '" . db_escape($phone) . "',
                display_order = $display_order,
                status = '$status'
                WHERE id = $id";
        
        if (db_query($sql)) {
            set_message('success', 'Committee member updated successfully');
        } else {
            set_message('danger', 'Failed to update committee member');
        }
    } else {
        // Insert
        $sql = "INSERT INTO committee_members (full_name, position, image, email, facebook, linkedin, phone, display_order, status) 
                VALUES ('" . db_escape($full_name) . "', '" . db_escape($position) . "', '" . db_escape($image) . "', '" . db_escape($email) . "', '" . db_escape($facebook) . "', '" . db_escape($linkedin) . "', '" . db_escape($phone) . "', $display_order, '$status')";
        
        if (db_query($sql)) {
            set_message('success', 'Committee member created successfully');
        } else {
            set_message('danger', 'Failed to create committee member');
        }
    }
    redirect(ADMIN_URL . '/committee.php');
}

// Fetch all committee members
$committee_query = "SELECT * FROM committee_members ORDER BY display_order ASC, id DESC";
$committee_result = db_query($committee_query);
$committee = db_fetch_all($committee_result);

include __DIR__ . '/includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users"></i> Committee Management</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#committeeModal" onclick="clearForm()">
        <i class="fas fa-plus"></i> Add Member
    </button>
</div>

<?php if (count($committee) > 0): ?>
<div class="row">
    <?php foreach ($committee as $member): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <?php if ($member['image']): ?>
                    <img src="<?php echo htmlspecialchars($member['image']); ?>" alt="<?php echo htmlspecialchars($member['full_name']); ?>" class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                <?php else: ?>
                    <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 120px; height: 120px;">
                        <i class="fas fa-user fa-3x"></i>
                    </div>
                <?php endif; ?>
                
                <h5 class="card-title"><?php echo htmlspecialchars($member['full_name']); ?></h5>
                <p class="text-muted mb-2"><?php echo htmlspecialchars($member['position']); ?></p>
                
                <div class="mb-3">
                    <span class="badge bg-<?php echo $member['status'] == 'active' ? 'success' : 'secondary'; ?>">
                        <?php echo ucfirst($member['status']); ?>
                    </span>
                    <span class="badge bg-info">Order: <?php echo $member['display_order']; ?></span>
                </div>
                
                <?php if ($member['email']): ?>
                    <p class="small mb-1"><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($member['email']); ?></p>
                <?php endif; ?>
                <?php if ($member['phone']): ?>
                    <p class="small mb-1"><i class="fas fa-phone"></i> <?php echo htmlspecialchars($member['phone']); ?></p>
                <?php endif; ?>
                
                <div class="mt-3">
                    <button class="btn btn-sm btn-warning" onclick='editMember(<?php echo json_encode($member); ?>)'>
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <a href="?delete=<?php echo $member['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="fas fa-trash"></i> Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="alert alert-info">No committee members found. Add your first member!</div>
<?php endif; ?>

<!-- Committee Modal -->
<div class="modal fade" id="committeeModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Committee Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="member_id">
                    
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Display Order</label>
                            <input type="number" name="display_order" id="display_order" class="form-control" value="0">
                            <small class="text-muted">Lower numbers appear first</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Position *</label>
                        <input type="text" name="position" id="position" class="form-control" placeholder="e.g., President, Vice President" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Image URL</label>
                        <input type="url" name="image" id="image" class="form-control" placeholder="https://example.com/image.jpg">
                        <small class="text-muted">Paste image URL from online source</small>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Facebook URL</label>
                            <input type="url" name="facebook" id="facebook" class="form-control" placeholder="https://facebook.com/...">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">LinkedIn URL</label>
                            <input type="url" name="linkedin" id="linkedin" class="form-control" placeholder="https://linkedin.com/in/...">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status *</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function clearForm() {
    document.getElementById('modalTitle').textContent = 'Add Committee Member';
    document.getElementById('member_id').value = '';
    document.getElementById('full_name').value = '';
    document.getElementById('position').value = '';
    document.getElementById('image').value = '';
    document.getElementById('email').value = '';
    document.getElementById('facebook').value = '';
    document.getElementById('linkedin').value = '';
    document.getElementById('phone').value = '';
    document.getElementById('display_order').value = '0';
    document.getElementById('status').value = 'active';
}

function editMember(member) {
    document.getElementById('modalTitle').textContent = 'Edit Committee Member';
    document.getElementById('member_id').value = member.id;
    document.getElementById('full_name').value = member.full_name;
    document.getElementById('position').value = member.position;
    document.getElementById('image').value = member.image || '';
    document.getElementById('email').value = member.email || '';
    document.getElementById('facebook').value = member.facebook || '';
    document.getElementById('linkedin').value = member.linkedin || '';
    document.getElementById('phone').value = member.phone || '';
    document.getElementById('display_order').value = member.display_order;
    document.getElementById('status').value = member.status;
    
    new bootstrap.Modal(document.getElementById('committeeModal')).show();
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
