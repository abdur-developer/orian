<?php
    // Search functionality
    $search = isset($_GET['search']) ? trim($_GET['search']) : '';
    $search_condition = '';
    if (!empty($search)) {
        $search = $conn->real_escape_string($search);
        $search_condition = " WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
    }

    // Fetch data
    $sql = "SELECT confirm_orders.status, users.name AS user_name, product.name AS product_name, orders.phone AS order_phone
        FROM confirm_orders 
        JOIN users ON confirm_orders.user_id = users.id
        JOIN product ON confirm_orders.product_id = product.id
        JOIN orders ON confirm_orders.order_id = orders.id
        $search_condition ORDER BY confirm_orders.id ASC";
    $result = $conn->query($sql);
?>
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0">
                    <i class="fas fa-truck-loading me-2"></i>
                    Orders Awaiting Delivery
                </h3>
                <div class="d-flex align-items-center">
                    <form class="d-flex search-box" method="get" action="">
                        <div class="input-group">
                            <input type="hidden" name="q" value="messages">
                            <input type="text" name="search" class="form-control border-end-0" placeholder="Search users..." value="<?= htmlspecialchars($search) ?>">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            <?php if (!empty($search)): ?>
                                <a href="?q=messages" class="btn btn-danger ms-1">
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
                                <th width="20%">Name</th>
                                <th width="20%">Phone</th>
                                <th width="20%">Product</th>
                                <th width="20%">Status</th>
                                <th width="20%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar me-2">
                                            <img src="https://ui-avatars.com/api/?name=<?= urlencode($row["user_name"]) ?>&background=random" class="rounded-circle" width="30" alt="User Avatar">
                                        </div>
                                        <?= htmlspecialchars($row["user_name"]) ?>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($row["order_phone"]) ?></td>
                                <td><?= htmlspecialchars($row["product_name"]) ?></td>
                                <td>
                                    <span class="status-badge status-inactive">
                                        <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i>
                                        <?= $row['status'] ?>
                                    </span>
                                </td>
                                <td class="text-center action-buttons">
                                    <button class="btn btn-sm btn-view me-1" title="View">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <!-- <button class="btn btn-sm btn-edit me-1" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-delete" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button> -->
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
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