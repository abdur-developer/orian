<?php
    // Pagination settings
    $limit = 10;
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $start_from = ($page - 1) * $limit;

    // Search and filter functionality
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $category = isset($_GET['category']) ? (int)$_GET['category'] : 0;

    $search_condition = '';
    $filter_conditions = [];

    if (!empty($search)) {
        $search = $conn->real_escape_string($search);
        $search_condition = " WHERE question LIKE '%$search%' OR explanation LIKE '%$search%'";
    }

    if ($category > 0) {
        $filter_conditions[] = "category_id = $category";
    }

    if (!empty($filter_conditions)) {
        $filter_condition = implode(' AND ', $filter_conditions);
        $search_condition = empty($search_condition) ? " WHERE $filter_condition" : " $search_condition AND $filter_condition";
    }

    // Fetch category for dropdown
    $category = [];
    $cat_result = $conn->query("SELECT id, name FROM category ORDER BY name");
    while ($row = $cat_result->fetch_assoc()) {
        $category[$row['id']] = $row['name'];
    }

    // Fetch data
    $sql = "SELECT * FROM questions 
            $search_condition 
            ORDER BY id DESC 
            LIMIT $start_from, $limit";
    /*$sql = "SELECT q.*, c.name as category_name 
            FROM questions q 
            LEFT JOIN category c ON q.category_id = c.id
            $search_condition 
            ORDER BY q.id DESC 
            LIMIT $start_from, $limit";
            */

    $result = $conn->query($sql);

    // Total records count
    $count_sql = "SELECT COUNT(*) as total FROM questions q $search_condition";
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
                <h3 class="mb-0"><i class="fas fa-question-circle me-2"></i>Quiz Question Management</h3>
                <button class="btn btn-success" onclick="location.href='?e=questions'">
                    <i class="fas fa-plus me-1"></i> Add Question
                </button>
            </div>
        </div>
        
        <div class="card-body">
            <!-- Filter Section -->
            <div class="filter-section mb-4">
                <form method="get" action="">
                    <div class="row g-3 justify-content-center align-items-center">
                        <input type="hidden" name="q" value="questions">
                        <div class="col-md-5">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Search questions..." value="<?= htmlspecialchars($search) ?>">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                                <?php if (!empty($search) || !empty($category)): ?>
                                    <a href="?q=questions" class="btn btn-danger">
                                        <i class="fas fa-times"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive table-container mb-4">
                    <table class="table table-hover question-table">
                        <thead>
                            <tr>
                                <th width="35%">Question</th>
                                <th width="10%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="question-text" title="<?= htmlspecialchars($row["question"]) ?>">
                                    <?= htmlspecialchars($row["question"]) ?>
                                </td>
                                <!-- <td><= htmlspecialchars($row["category_name"] ?? 'Uncategorized') ?></td>
                                <td><= ucfirst($row["question_type"]) ?></td>
                                -->
                                <td class="text-center action-buttons">
                                    <button class="btn btn-sm btn-edit me-1" title="Edit" onclick="location.href='?e=questions&id=<?= encryptSt($row['id']) ?>'">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-delete" title="Delete"  data-bs-toggle="modal" data-id="<?= htmlspecialchars($row["id"]) ?>"  data-bs-target="#deleteItemModel">
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
                        Showing <strong><?= ($start_from + 1) ?></strong> to <strong><?= min($start_from + $limit, $total_rows) ?></strong> of <strong><?= $total_rows ?></strong> questions
                    </div>
                    
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <!-- First Page -->
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=1<?= !empty($search) ? '&search='.urlencode($search) : '' ?><?= $category > 0 ? '&category='.$category : '' ?>" aria-label="First">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                            
                            <!-- Previous Page -->
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page-1 ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?><?= $category > 0 ? '&category='.$category : '' ?>" aria-label="Previous">
                                    <i class="fas fa-angle-left"></i>
                                </a>
                            </li>
                            
                            <!-- Page Numbers -->
                            <?php if ($start_range > 1): ?>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                            
                            <?php for ($i = $start_range; $i <= $end_range; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?page=<?= $i ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?><?= $category > 0 ? '&category='.$category : '' ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if ($end_range < $total_pages): ?>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                            
                            <!-- Next Page -->
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $page+1 ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?><?= $category > 0 ? '&category='.$category : '' ?>" aria-label="Next">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                            </li>
                            
                            <!-- Last Page -->
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?page=<?= $total_pages ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?><?= $category > 0 ? '&category='.$category : '' ?>" aria-label="Last">
                                    <i class="fas fa-angle-double-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-question fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">
                        <?php if (!empty($search) || !empty($category)): ?>
                            No questions found matching your criteria
                        <?php else: ?>
                            No questions found in the database
                        <?php endif; ?>
                    </h4>
                    <?php if (!empty($search) || !empty($category)): ?>
                        <a href="?" class="btn btn-primary mt-2">
                            <i class="fas fa-undo me-1"></i> Reset Filters
                        </a>
                    <?php else: ?>
                        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                            <i class="fas fa-plus me-1"></i> Add New Question
                        </button>
                    <?php endif; ?>
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
                body: JSON.stringify({ id: idToDelete, table: 'questions' })
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