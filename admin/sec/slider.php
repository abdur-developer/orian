<?php
    // Pagination settings
    $limit = 5;
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $start_from = ($page - 1) * $limit;

    // Fetch data
    $sql = "SELECT * FROM slider ORDER BY id ASC LIMIT $start_from, $limit";
    $result = $conn->query($sql);

    // Total records count
    $count_sql = "SELECT COUNT(*) as total FROM slider";
    $total_result = $conn->query($count_sql);
    $total_rows = $total_result->fetch_assoc()['total'];
    $total_pages = ceil($total_rows / $limit);

    // Calculate page range
    $start_range = max(1, $page - 2);
    $end_range = min($total_pages, $page + 2);
?>
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-users-cog me-2"></i>slider Management</h3>
                <div class="d-flex align-items-center">
                    <button class="btn btn-success ms-3 add-new" onclick="location.href='?e=slider'">
                        <i class="fas fa-plus me-1"></i> Add new
                    </button>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive table-container mb-4">
                    <table class="table table-hover user-table">
                        <thead>
                            <tr>
                                <th width="20%">Image</th>
                                <th width="50%">Link</th>
                                <th width="30%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><img src="upload/<?= htmlspecialchars($row["img"]) ?>" class="img-fluid"></td>
                                <td><a href="<?= htmlspecialchars($row["link"]) ?>" target="_blank"><?= htmlspecialchars($row["link"]) ?></a></td>
                                <td class="text-center action-buttons">
                                    <button class="btn btn-sm btn-edit me-1" title="Edit" onclick="location.href='?e=slider&id=<?= encryptSt($row['id']) ?>'">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-delete" title="Delete" data-bs-toggle="modal" data-id="<?= htmlspecialchars($row["id"]) ?>"  data-bs-target="#deleteItemModel">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Showing <strong><?= ($start_from + 1) ?></strong> to <strong><?= min($start_from + $limit, $total_rows) ?></strong> of <strong><?= $total_rows ?></strong> entries
                    </div>
                    
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <!-- First Page -->
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?q=slider&page=1" aria-label="First">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                            
                            <!-- Previous Page -->
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?q=slider&page=<?= $page-1 ?>" aria-label="Previous">
                                    <i class="fas fa-angle-left"></i>
                                </a>
                            </li>
                            
                            <!-- Page Numbers -->
                            <?php if ($start_range > 1): ?>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                            
                            <?php for ($i = $start_range; $i <= $end_range; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?q=slider&page=<?= $i ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if ($end_range < $total_pages): ?>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                            
                            <!-- Next Page -->
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?q=slider&page=<?= $page+1 ?>" aria-label="Next">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                            </li>
                            
                            <!-- Last Page -->
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?q=slider&page=<?= $total_pages ?>" aria-label="Last">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-user-slash fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">No slider found in the database</h4>
                    <button class="btn btn-primary mt-2 add-new"  onclick="location.href='?e=slider'">
                        <i class="fas fa-plus me-1"></i> Add New
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deleteItemModel" tabindex="-1" aria-labelledby="deleteItemModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="deleteItemModelLabel"><i class="fas fa-trash-alt me-2"></i>Delete Confirmation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this chat suggestion? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" data-id="" id="btnConfirmDelete">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Custom JS -->
<script>
    // Tooltip initialization
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');
                document.getElementById('btnConfirmDelete').setAttribute('data-id', itemId);
            });
        });

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            const idToDelete = this.getAttribute('data-id');
            fetch('api/delete.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: idToDelete, table: 'slider' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    toast(data.message, 'error');
                }
            })
            .catch(error => {
                toast('An error occurred while deleting.', 'error');
            });
        });
    });
</script>