<?php
    // Pagination settings
    $limit = 10;
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $start_from = ($page - 1) * $limit;

    // Search functionality
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $search_condition = '';
    if (!empty($search)) {
        $search = $conn->real_escape_string($search);
        $search_condition = " WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
    }

    // Fetch data
    $sql = "SELECT * FROM users $search_condition ORDER BY id ASC LIMIT $start_from, $limit";
    $result = $conn->query($sql);

    // Total records count
    $count_sql = "SELECT COUNT(*) as total FROM users $search_condition";
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
                <h3 class="mb-0"><i class="fas fa-users-cog me-2"></i>User Management System</h3>
                <div class="d-flex align-items-center">
                    <form class="d-flex search-box" method="get" action="">
                        <div class="input-group">
                            <input type="hidden" name="q" value="users">
                            <input type="text" name="search" class="form-control border-end-0" placeholder="Search users..." value="<?= htmlspecialchars($search) ?>">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            <?php if (!empty($search)): ?>
                                <a href="?q=users" class="btn btn-danger ms-1">
                                    <i class="fas fa-times"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive table-container mb-4">
                    <table class="table table-hover user-table">
                        <thead>
                            <tr>
                                <th width="25%">Name</th>
                                <th width="25%">Email</th>
                                <th width="25%">Status</th>
                                <th width="25%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2">
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($row["name"]) ?>&background=random" class="rounded-circle" width="30" alt="User Avatar">
                                        </div>
                                        <?= htmlspecialchars($row["name"]) ?>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($row["email"]) ?></td>
                                <td>
                                    <span class="status-badge <?= $row['status'] == 1 ? 'status-active' : 'status-inactive' ?>">
                                        <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i>
                                        <?= $row['status'] == 1 ? 'Active' : 'Inactive' ?>
                                    </span>
                                </td>
                                <td class="text-center action-buttons">
                                    <button class="btn btn-sm btn-edit me-1" title="Edit" onclick="location.href='?e=users&id=<?= encryptSt($row['id']) ?>'">
                                        <i class="fas fa-edit"></i>
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
                        <?php if (!empty($search)): ?>
                            (filtered from total)
                        <?php endif; ?>
                    </div>
                    
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <!-- First Page -->
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?q=users&page=1<?= !empty($search) ? '&search='.urlencode($search) : '' ?>" aria-label="First">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                            
                            <!-- Previous Page -->
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?q=users&page=<?= $page-1 ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?>" aria-label="Previous">
                                    <i class="fas fa-angle-left"></i>
                                </a>
                            </li>
                            
                            <!-- Page Numbers -->
                            <?php if ($start_range > 1): ?>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                            
                            <?php for ($i = $start_range; $i <= $end_range; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?q=users&page=<?= $i ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if ($end_range < $total_pages): ?>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                            
                            <!-- Next Page -->
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?q=users&page=<?= $page+1 ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?>" aria-label="Next">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                            </li>
                            
                            <!-- Last Page -->
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?q=users&page=<?= $total_pages ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?>" aria-label="Last">
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
                    <h4 class="text-muted mb-3">
                        <?php if (!empty($search)): ?>
                            No users found matching your search criteria
                        <?php else: ?>
                            No users found in the database
                        <?php endif; ?>
                    </h4>
                    <?php if (!empty($search)): ?>
                        <a href="?" class="btn btn-primary mt-2">
                            <i class="fas fa-undo me-1"></i> Reset Search
                        </a>
                    <?php else: ?>
                        <button class="btn btn-primary mt-2 add-new" data-bs-toggle="modal" data-bs-target="#addItemModel">
                            <i class="fas fa-plus me-1"></i> Add New
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
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
    });
</script>