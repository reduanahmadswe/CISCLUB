<?php
require_once __DIR__ . '/../config/config.php';

if (!is_admin_logged_in()) {
    redirect(ADMIN_URL . '/login.php');
}

$page_title = 'Manage Sponsors';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $sql = "DELETE FROM sponsors WHERE id = $id";
    if (db_query($sql)) {
        set_message('success', 'Sponsor deleted successfully');
    } else {
        set_message('danger', 'Failed to delete sponsor');
    }
    redirect(ADMIN_URL . '/sponsors.php');
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sponsor_name = clean_input($_POST['sponsor_name']);
    $logo = clean_input($_POST['logo']);
    $website = clean_input($_POST['website']);
    $description = clean_input($_POST['description']);
    $status = $_POST['status'];
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update
        $id = (int)$_POST['id'];
        $sql = "UPDATE sponsors SET 
                sponsor_name = '" . db_escape($sponsor_name) . "',
                logo = '" . db_escape($logo) . "',
                website = '" . db_escape($website) . "',
                description = '" . db_escape($description) . "',
                status = '$status'
                WHERE id = $id";
        
        if (db_query($sql)) {
            set_message('success', 'Sponsor updated successfully');
        } else {
            set_message('danger', 'Failed to update sponsor');
        }
    } else {
        // Insert
        $sql = "INSERT INTO sponsors (sponsor_name, logo, website, description, status) 
                VALUES ('" . db_escape($sponsor_name) . "', '" . db_escape($logo) . "', '" . db_escape($website) . "', '" . db_escape($description) . "', '$status')";
        
        if (db_query($sql)) {
            set_message('success', 'Sponsor created successfully');
        } else {
            set_message('danger', 'Failed to create sponsor');
        }
    }
    redirect(ADMIN_URL . '/sponsors.php');
}

// Fetch all sponsors
$sponsors_query = "SELECT * FROM sponsors ORDER BY created_at DESC";
$sponsors_result = db_query($sponsors_query);
$sponsors = db_fetch_all($sponsors_result);

include __DIR__ . '/includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-handshake"></i> Sponsors Management</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#sponsorModal" onclick="clearForm()">
        <i class="fas fa-plus"></i> Add Sponsor
    </button>
</div>

<?php if (count($sponsors) > 0): ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Logo</th>
                        <th>Sponsor Name</th>
                        <th>Website</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sponsors as $sponsor): ?>
                    <tr>
                        <td><?php echo $sponsor['id']; ?></td>
                        <td>
                            <?php if ($sponsor['logo']): ?>
                                <img src="<?php echo htmlspecialchars($sponsor['logo']); ?>" alt="Logo" style="width: 50px; height: 50px; object-fit: contain;">
                            <?php else: ?>
                                <i class="fas fa-image fa-2x text-muted"></i>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($sponsor['sponsor_name']); ?></td>
                        <td>
                            <?php if ($sponsor['website']): ?>
                                <a href="<?php echo htmlspecialchars($sponsor['website']); ?>" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Visit
                                </a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge bg-<?php echo $sponsor['status'] == 'active' ? 'success' : 'secondary'; ?>">
                                <?php echo ucfirst($sponsor['status']); ?>
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick='editSponsor(<?php echo json_encode($sponsor); ?>)'>
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="?delete=<?php echo $sponsor['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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
<div class="alert alert-info">No sponsors found. Add your first sponsor!</div>
<?php endif; ?>

<!-- Sponsor Modal -->
<div class="modal fade" id="sponsorModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Sponsor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="sponsor_id">
                    
                    <div class="mb-3">
                        <label class="form-label">Sponsor Name *</label>
                        <input type="text" name="sponsor_name" id="sponsor_name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Logo URL</label>
                        <input type="url" name="logo" id="logo" class="form-control" placeholder="https://example.com/logo.png">
                        <small class="text-muted">Paste logo image URL</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Website URL</label>
                        <input type="url" name="website" id="website" class="form-control" placeholder="https://example.com">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
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
                    <button type="submit" class="btn btn-primary">Save Sponsor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function clearForm() {
    document.getElementById('modalTitle').textContent = 'Add Sponsor';
    document.getElementById('sponsor_id').value = '';
    document.getElementById('sponsor_name').value = '';
    document.getElementById('logo').value = '';
    document.getElementById('website').value = '';
    document.getElementById('description').value = '';
    document.getElementById('status').value = 'active';
}

function editSponsor(sponsor) {
    document.getElementById('modalTitle').textContent = 'Edit Sponsor';
    document.getElementById('sponsor_id').value = sponsor.id;
    document.getElementById('sponsor_name').value = sponsor.sponsor_name;
    document.getElementById('logo').value = sponsor.logo || '';
    document.getElementById('website').value = sponsor.website || '';
    document.getElementById('description').value = sponsor.description || '';
    document.getElementById('status').value = sponsor.status;
    
    new bootstrap.Modal(document.getElementById('sponsorModal')).show();
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
