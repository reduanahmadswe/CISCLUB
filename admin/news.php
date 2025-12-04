<?php
require_once __DIR__ . '/../config/config.php';

if (!is_admin_logged_in()) {
    redirect(ADMIN_URL . '/login.php');
}

$page_title = 'Manage News';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $sql = "DELETE FROM news WHERE id = $id";
    if (db_query($sql)) {
        set_message('success', 'News deleted successfully');
    } else {
        set_message('danger', 'Failed to delete news');
    }
    redirect(ADMIN_URL . '/news.php');
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = clean_input($_POST['title']);
    $description = clean_input($_POST['description']);
    $image = clean_input($_POST['image']);
    $status = $_POST['status'];
    
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Update
        $id = (int)$_POST['id'];
        $sql = "UPDATE news SET 
                title = '" . db_escape($title) . "',
                description = '" . db_escape($description) . "',
                image = '" . db_escape($image) . "',
                status = '$status'
                WHERE id = $id";
        
        if (db_query($sql)) {
            set_message('success', 'News updated successfully');
        } else {
            set_message('danger', 'Failed to update news');
        }
    } else {
        // Insert
        $sql = "INSERT INTO news (title, description, image, status) 
                VALUES ('" . db_escape($title) . "', '" . db_escape($description) . "', '" . db_escape($image) . "', '$status')";
        
        if (db_query($sql)) {
            set_message('success', 'News created successfully');
        } else {
            set_message('danger', 'Failed to create news');
        }
    }
    redirect(ADMIN_URL . '/news.php');
}

// Fetch all news
$news_query = "SELECT * FROM news ORDER BY created_at DESC";
$news_result = db_query($news_query);
$news = db_fetch_all($news_result);

include __DIR__ . '/includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-newspaper"></i> News Management</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newsModal" onclick="clearForm()">
        <i class="fas fa-plus"></i> Add News
    </button>
</div>

<?php if (count($news) > 0): ?>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($news as $item): ?>
                    <tr>
                        <td><?php echo $item['id']; ?></td>
                        <td>
                            <?php if ($item['image']): ?>
                                <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="News" style="width: 50px; height: 50px; object-fit: cover;">
                            <?php else: ?>
                                <i class="fas fa-image fa-2x text-muted"></i>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($item['title']); ?></td>
                        <td>
                            <span class="badge bg-<?php echo $item['status'] == 'published' ? 'success' : 'secondary'; ?>">
                                <?php echo ucfirst($item['status']); ?>
                            </span>
                        </td>
                        <td><?php echo time_ago($item['created_at']); ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick='editNews(<?php echo json_encode($item); ?>)'>
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="?delete=<?php echo $item['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
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
<div class="alert alert-info">No news found. Create your first news!</div>
<?php endif; ?>

<!-- News Modal -->
<div class="modal fade" id="newsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add News</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="news_id">
                    
                    <div class="mb-3">
                        <label class="form-label">Title *</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Description *</label>
                        <textarea name="description" id="description" class="form-control" rows="6" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Image URL</label>
                        <input type="url" name="image" id="image" class="form-control" placeholder="https://example.com/image.jpg">
                        <small class="text-muted">Paste image URL from online source</small>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Status *</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save News</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function clearForm() {
    document.getElementById('modalTitle').textContent = 'Add News';
    document.getElementById('news_id').value = '';
    document.getElementById('title').value = '';
    document.getElementById('description').value = '';
    document.getElementById('image').value = '';
    document.getElementById('status').value = 'published';
}

function editNews(news) {
    document.getElementById('modalTitle').textContent = 'Edit News';
    document.getElementById('news_id').value = news.id;
    document.getElementById('title').value = news.title;
    document.getElementById('description').value = news.description;
    document.getElementById('image').value = news.image || '';
    document.getElementById('status').value = news.status;
    
    new bootstrap.Modal(document.getElementById('newsModal')).show();
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
