<?php
    // Search functionality
    $search = isset($_REQUEST['search']) ? trim($_REQUEST['search']) : '';
    
    $where_cause = "WHERE confirm_orders.type = 'product' AND confirm_orders.status = ";
    if(empty($search)){
        $where_cause .= "'Order Confirm'";
    }else{
        $search = $conn->real_escape_string($search);
        $where_cause .= "'$search'";
    }
    // Fetch data
    $sql = "SELECT confirm_orders.id, confirm_orders.status, users.name AS user_name, product.name AS product_name, orders.phone AS order_phone
        FROM confirm_orders 
        JOIN users ON confirm_orders.user_id = users.id 
        JOIN product ON confirm_orders.product_id = product.id 
        JOIN orders ON confirm_orders.order_id = orders.id 
        $where_cause 
        ORDER BY confirm_orders.id DESC LIMIT 100";
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
                    <form class="d-flex search-box" method="post">
                        <div class="input-group">
                            <input type="hidden" name="q" value="confirm_orders">
                            <select name="search" class="form-control border-end-0">
                                <option value="Order Confirm" <?= $search == "Order Confirm" ? "selected" : "" ?>>Processing</option>
                                <option value="ready" <?= $search == "ready" ? "selected" : "" ?>>Ready for Shipping</option>
                                <option value="delivery" <?= $search == "delivery" ? "selected" : "" ?>>On Delivery</option>
                                <option value="delivered" <?= $search == "delivered" ? "selected" : "" ?>>Delivered</option>
                                <option value="cancelled" <?= $search == "cancelled" ? "selected" : "" ?>>Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            <?php if (!empty($search)): ?>
                                <a href="?q=confirm_orders" class="btn btn-danger ms-1">
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
                                <th width="20%">Phone</th>
                                <th width="25%">Product</th>
                                <th width="20%">Status</th>
                                <th width="10%" class="text-center">Actions</th>
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
                                <td><?= htmlspecialchars(chotoKro($row["product_name"])) ?></td>
                                <td>
                                    <span class="status-badge status-inactive">
                                        <i class="fas fa-circle me-1" style="font-size: 0.5rem;"></i>
                                        <?= $row['status'] ?>
                                    </span>
                                </td>
                                <td class="text-center action-buttons">
                                    <button class="btn btn-sm btn-view me-1" title="View" onclick="location.href='?e=confirm_orders&id=<?= encryptSt($row['id']) ?>'">
                                        <i class="fas fa-eye"></i>
                                    </button>
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