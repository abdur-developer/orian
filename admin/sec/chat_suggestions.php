<?php
    // Pagination settings
    $limit = 10;
    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
    $start_from = ($page - 1) * $limit;

    // Fetch data
    $sql = "SELECT * FROM chat_suggestions ORDER BY id ASC LIMIT $start_from, $limit";
    $result = $conn->query($sql);

    // Total records count
    $count_sql = "SELECT COUNT(*) as total FROM chat_suggestions";
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
                <h3 class="mb-0"><i class="fas fa-users-cog me-2"></i>Chat Suggestions</h3>
                <div class="d-flex align-items-center">
                    <button class="btn btn-success ms-3 add-new" data-bs-toggle="modal" data-bs-target="#addItemModel">
                        <i class="fas fa-plus me-1"></i> Add New
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
                                <th width="50%">Message Text</th>
                                <th width="25%">Response Text</th>
                                <th width="25%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row["message_text"]) ?></td>
                                <td><?= htmlspecialchars(chotoKro($row["response_text"], 50)) ?></td>
                                <td class="text-center action-buttons">
                                    <button class="btn btn-sm btn-view me-1" title="View" data-bs-toggle="modal" data-message="<?= htmlspecialchars($row["message_text"]) ?>" data-response="<?= htmlspecialchars($row["response_text"]) ?>"  data-bs-target="#viewItemModel">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-edit me-1" title="Edit" data-bs-toggle="modal" data-id="<?= htmlspecialchars($row["id"]) ?>"  data-bs-target="#addItemModel">
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
                        <?php if (!empty($search)): ?>
                            (filtered from total)
                        <?php endif; ?>
                    </div>
                    
                    <nav aria-label="Page navigation">
                        <ul class="pagination mb-0">
                            <!-- First Page -->
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?q=chat_suggestions&page=1<?= !empty($search) ? '&search='.urlencode($search) : '' ?>" aria-label="First">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                            
                            <!-- Previous Page -->
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?q=chat_suggestions&page=<?= $page-1 ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?>" aria-label="Previous">
                                    <i class="fas fa-angle-left"></i>
                                </a>
                            </li>
                            
                            <!-- Page Numbers -->
                            <?php if ($start_range > 1): ?>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                            
                            <?php for ($i = $start_range; $i <= $end_range; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link" href="?q=chat_suggestions&page=<?= $i ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            
                            <?php if ($end_range < $total_pages): ?>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                            
                            <!-- Next Page -->
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?q=chat_suggestions&page=<?= $page+1 ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?>" aria-label="Next">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                            </li>
                            
                            <!-- Last Page -->
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
                                <a class="page-link" href="?q=chat_suggestions&page=<?= $total_pages ?><?= !empty($search) ? '&search='.urlencode($search) : '' ?>" aria-label="Last">
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
                            No chat_suggestions found matching your search criteria
                        <?php else: ?>
                            No chat_suggestions found in the database
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

<!-- Add New Modal -->
<div class="modal fade" id="addItemModel" tabindex="-1" aria-labelledby="addItemModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addItemModelLabel"><i class="fas fa-user-plus me-2"></i>Add New</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" action="admin.php" method="POST">
                    <input type="hidden" name="editId" id="editId" value="">
                    <div class="mb-3">
                        <label for="question" class="form-label">Question text..?</label>
                        <input type="text" class="form-control" id="question" name="chat_suggestion_question" required>
                    </div>
                    <div class="mb-3">
                        <label for="reply" class="form-label">Response text</label>
                        <input type="text" class="form-control" id="reply" name="reply" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <label class="form-label">Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="statusActive" value="1" checked>
                            <label class="form-check-label" for="statusActive">
                                Initial
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="statusInactive" value="0" onclick="toggleParentMessage(true)">
                            <label class="form-check-label" for="statusInactive">
                                Linked
                            </label>
                        </div>
                    </div>
                    <div class="mb-3 d-none">
                        <label for="parentMessage" class="form-label">Select Message</label>
                        <select class="form-select" id="parentMessage" name="parentId">
                            <!-- Get from database when this visible -->
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
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
<!-- View Modal -->
<div class="modal fade" id="viewItemModel" tabindex="-1" aria-labelledby="viewItemModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="viewItemModelLabel"><i class="fas fa-eye me-2"></i><span id="viewQ"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"><p id="viewR"></p></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Custom JS -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let hiddenInput = document.getElementById('editId');

        document.querySelectorAll('.btn-view').forEach(function(button) {
            button.addEventListener('click', function() {
                document.getElementById('viewQ').innerHTML = this.getAttribute('data-message');
                document.getElementById('viewR').innerHTML = this.getAttribute('data-response');                
            });
        });
        document.querySelectorAll('.add-new').forEach(function(button) {
            button.addEventListener('click', function() {
                document.getElementById('addItemModelLabel').innerHTML = `<i class="fas fa-user-plus me-2"></i>Add New`;
                
                hiddenInput = '';
                document.getElementById('question').value = '';
                document.getElementById('reply').value = '';
                document.getElementById('statusActive').checked = true;
                toggleParentMessage(false);
            });
        });
        document.querySelectorAll('.btn-edit').forEach(function(button) {
            button.addEventListener('click', function() {
                document.getElementById('addItemModelLabel').innerHTML = `<i class="fas fa-edit me-2"></i>Edit now`;
                const itemId = this.getAttribute('data-id');

                fetch('api/get/suggestions.php?id=' + itemId)
                    .then(response => response.json())
                    .then(data => {
                        hiddenInput.value = itemId;

                        // Set values
                        document.getElementById('question').value = data.message_text || '';
                        document.getElementById('reply').value = data.response_text || '';

                        // Set type radio
                        if (data.is_initial == 0) {
                            document.getElementById('statusInactive').checked = true;
                            toggleParentMessage(true);
                            // Set parentId if exists
                            setTimeout(function() {
                                if (data.parent_id) {
                                    document.getElementById('parentMessage').value = data.parent_id;
                                }
                            }, 300);
                        } else {
                            document.getElementById('statusActive').checked = true;
                            toggleParentMessage(false);
                        }
                    });
                               
            });
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
                body: JSON.stringify({ id: idToDelete, table: 'chat_suggestions' })
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

        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        var radios = document.querySelectorAll('input[name="type"]');
        radios.forEach(function(radio) {
            radio.addEventListener('change', function() {
                toggleParentMessage(this.value == "0");
            });
        });
        var checked = document.querySelector('input[name="type"]:checked');
        if (checked) toggleParentMessage(checked.value == "0");
    });
    function toggleParentMessage(show) {
        var parentDiv = document.querySelector('.mb-3.d-none[for="parentMessage"], .mb-3.d-none #parentMessage')?.closest('.mb-3');
        if (!parentDiv) parentDiv = document.getElementById('parentMessage')?.closest('.mb-3');
        if (!parentDiv) return;
        const select = document.getElementById('parentMessage');
        if (show) {
            parentDiv.classList.remove('d-none');
            fetch('api/get/suggestions.php')
                .then(response => response.json())
                .then(data => {
                    select.innerHTML = '';
                    data.forEach(function(item) {
                        var option = document.createElement('option');
                        option.value = item.id;
                        option.textContent = item.message_text;
                        select.appendChild(option);
                    });
                });
        } else {
            parentDiv.classList.add('d-none');
            select.innerHTML = '';
        }
    }
</script>