<?php
require_once __DIR__ . '/../config/config.php';

if (!is_admin_logged_in()) {
    redirect(ADMIN_URL . '/login.php');
}

$page_title = 'Categories';

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $delete_query = "DELETE FROM categories WHERE id = $id";
    if (db_query($delete_query)) {
        set_message('success', 'Category deleted successfully');
    } else {
        set_message('danger', 'Failed to delete category');
    }
    redirect(ADMIN_URL . '/categories.php');
}

// Handle add/edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $category_name = clean_input($_POST['category_name']);
    $description = clean_input($_POST['description']);
    $status = clean_input($_POST['status']);
    
    if ($id > 0) {
        // Update
        $sql = "UPDATE categories SET 
                category_name = '" . db_escape($category_name) . "',
                description = '" . db_escape($description) . "',
                status = '" . db_escape($status) . "'
                WHERE id = $id";
        $message = 'Category updated successfully';
    } else {
        // Insert
        $sql = "INSERT INTO categories (category_name, description, status) 
                VALUES ('" . db_escape($category_name) . "', 
                        '" . db_escape($description) . "', 
                        '" . db_escape($status) . "')";
        $message = 'Category added successfully';
    }
    
    if (db_query($sql)) {
        set_message('success', $message);
        redirect(ADMIN_URL . '/categories.php');
    } else {
        set_message('danger', 'Operation failed');
    }
}

// Fetch all categories
$categories_query = "SELECT * FROM categories ORDER BY created_at DESC";
$categories = db_fetch_all(db_query($categories_query));

include __DIR__ . '/includes/header.php';
?>

<div class="d-flex justify-content-between mb-3">
    <div></div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal" onclick="resetForm()">
        <i class="fas fa-plus"></i> Add Category
    </button>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?php echo $category['id']; ?></td>
                            <td><?php echo htmlspecialchars($category['category_name']); ?></td>
                            <td><?php echo substr(htmlspecialchars($category['description']), 0, 50); ?>...</td>
                            <td>
                                <span class="badge bg-<?php echo $category['status'] == 'active' ? 'success' : 'secondary'; ?>">
                                    <?php echo ucfirst($category['status']); ?>
                                </span>
                            </td>
                            <td><?php echo format_date($category['created_at']); ?></td>
                            <td>
                                <button class="btn btn-sm btn-info" onclick='editCategory(<?php echo json_encode($category); ?>)'>
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="?delete=<?php echo $category['id']; ?>" 
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

<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="categoryId">
                    
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="category_name" id="categoryName" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="categoryDesc" class="form-control" rows="3"></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" id="categoryStatus" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function resetForm() {
    document.getElementById('modalTitle').innerText = 'Add Category';
    document.getElementById('categoryId').value = '';
    document.getElementById('categoryName').value = '';
    document.getElementById('categoryDesc').value = '';
    document.getElementById('categoryStatus').value = 'active';
}

function editCategory(category) {
    document.getElementById('modalTitle').innerText = 'Edit Category';
    document.getElementById('categoryId').value = category.id;
    document.getElementById('categoryName').value = category.category_name;
    document.getElementById('categoryDesc').value = category.description;
    document.getElementById('categoryStatus').value = category.status;
    new bootstrap.Modal(document.getElementById('categoryModal')).show();
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
