<?php
// Get order ID from URL
$con_order_id = isset($_GET['id']) ? intval(decryptSt($_GET['id'])) : 0;

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $new_status = $_POST['status'];
    $status_id = $_POST['status_id'];
    $stmt = $conn->prepare("UPDATE orders SET co_status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $status_id);
    $stmt->execute();
    $stmt->close();
    header("Location: ?e=confirm_orders&id=".encryptSt($con_order_id)."&success=Status+updated");
    exit();
}

// Fetch order details
$order = null;
$products = null;
$user_details = [];
// Get order information
$sql = "SELECT o.* FROM orders o LEFT JOIN confirm_orders co ON o.id = co.order_id WHERE co.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $con_order_id);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();
// echo $con_order_id;
// echo "<pre>";
// var_dump($order);
// echo "</pre>";
$stmt->close();

if ($order) {
    // Get user details if available
    if ($order['user_id']) {
        $user_details = [
            'name' => $order['name'],
            'profile_pic' => 'https://randomuser.me/api/portraits/men/32.jpg'
        ];
    }

    $stmt = $conn->prepare("
        SELECT 
            confirm_orders.*, product.name, 
            product.colors, product.img, product.sizes
        FROM confirm_orders
        INNER JOIN product ON product.id = confirm_orders.product_id
        WHERE confirm_orders.order_id = ?
    ");
    $stmt->bind_param("i", $order['id']);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    $stmt->close();
}

// Format dates
$order_date = $order ? date('F j, Y', strtotime($order['created_at'])) : date('F j, Y');
$order_time = $order ? date('g:i A', strtotime($order['created_at'])) : '';
$order_number = $order ? 'ORD-'.date('Y', strtotime($order['created_at'])).'-'.str_pad($order['id'], 5, '0', STR_PAD_LEFT) : 'ORD-'.date('Y').'-XXXXX';
?>

<style>
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --success-color: #4cc9f0;
        --info-color: #4895ef;
        --warning-color: #f8961e;
        --danger-color: #f72585;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }
    
    .order-details-container {
        max-width: 1200px;
        margin: 0 auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .order-header {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 10px 10px 0 0;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    .order-card {
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        border: none;
    }
    
    .order-timeline {
        position: relative;
        padding-left: 50px;
        margin: 2rem 0;
    }
    
    .order-timeline:before {
        content: '';
        position: absolute;
        left: 20px;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, var(--primary-color), var(--success-color));
    }
    
    .timeline-step {
        position: relative;
        margin-bottom: 2rem;
        transition: all 0.3s ease;
    }
    
    .timeline-step:hover {
        transform: translateX(5px);
    }
    
    .timeline-icon {
        position: absolute;
        left: -50px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 2;
    }
    
    .timeline-content {
        padding: 1rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
    }
    
    .completed .timeline-content {
        background: #f0f8ff;
        border-left-color: var(--success-color);
    }
    
    .active .timeline-content {
        background: #e6f2ff;
        border-left-color: var(--primary-color);
    }
    
    .product-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .product-img:hover {
        transform: scale(1.05);
    }
    
    .info-card {
        border-radius: 8px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .info-card .card-header {
        background-color: var(--light-color);
        border-bottom: 1px solid rgba(0,0,0,0.05);
        font-weight: 600;
    }
    
    .status-badge {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        border-radius: 50px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .user-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .table thead th {
        background-color: var(--light-color);
        font-weight: 600;
        border-bottom-width: 1px;
    }
    
    .table tbody tr {
        transition: background-color 0.2s ease;
    }
    
    .table tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
    
    .total-row {
        font-weight: 600;
        background-color: rgba(67, 97, 238, 0.05) !important;
    }
    
    @media (max-width: 768px) {
        .order-timeline {
            padding-left: 40px;
        }
        
        .timeline-icon {
            left: -40px;
            width: 30px;
            height: 30px;
            font-size: 0.8rem;
        }
        
        .product-img {
            width: 60px;
            height: 60px;
        }
    }
</style>

<div class="order-details-container">
    <div class="card order-card mb-4">
        <!-- Order Header -->
        <div class="order-header">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center mb-3 mb-md-0">
                    <?php if (!empty($user_details)): ?>
                        <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="User" class="user-avatar me-3">
                        <div>
                            <h4 class="mb-0"><?= htmlspecialchars($user_details['name']) ?></h4>
                            <small class="text-white-80">Customer</small>
                        </div>
                    <?php else: ?>
                        <div class="user-avatar bg-white text-primary d-flex align-items-center justify-content-center me-3">
                            <i class="fas fa-user fa-lg"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">Guest Customer</h4>
                            <small class="text-white-80">No account</small>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="text-end">
                    <h3 class="mb-1">Order #<?= htmlspecialchars($order_number) ?></h3>
                    <p class="mb-0 text-white-80">
                        <i class="far fa-calendar-alt me-1"></i> 
                        <?= htmlspecialchars($order_date) ?> at <?= htmlspecialchars($order_time) ?>
                    </p>
                </div>
            </div>
        </div>
        <style>
            .feedback-card {
                border-radius: 12px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                border: none;
                margin: 0;
                transition: all 0.3s ease;
            }            
            .form-label {
                font-weight: 600;
                color: var(--dark-color);
                font-size: 0.9rem;
                margin-bottom: 0.5rem;
            }
            
            .form-control, .form-select {
                border-radius: 8px;
                border: 1px solid #e2e8f0;
                transition: all 0.2s ease;
            }
            
            .form-control:focus, .form-select:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
            }
        </style>
        <form class="alert alert-info feedback-card" action="" method="post">
            <?php
                $sql = "SELECT feedback, show_feedback FROM users WHERE id = {$order['user_id']}";
                $feedback = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            ?>
            <div class="row g-3">
                <div class="col-md-7">
                    <label for="feedbackText" class="form-label">Feedback Message</label>
                    <input type="text" name="feedback_txt" id="feedbackText" class="form-control" value="<?= $feedback['feedback'] ?? "order place" ?>" placeholder="Enter your feedback message here...">
                    <input type="hidden" name="user_id" value="<?=$order['user_id']?>">
                    <input type="hidden" name="order_id" value="<?=$_GET['id']?>">
                </div>
                <div class="col-md-3">
                    <label for="is_show" class="form-label">Visibility</label>
                    <select name="is_show" id="is_show" class="form-select">
                        <option value="0" <?= $feedback['show_feedback'] == 0 ? 'selected':'' ?>>Only Admin</option>
                        <option value="1" <?= $feedback['show_feedback'] == 1 ? 'selected':'' ?>>Admin & User</option>
                    </select>
                </div>
                
                <div class="col-md-2 d-flex align-items-end">
                    <div class="btn-group w-100">
                        <button type="submit" class="btn btn-success align-items-center">
                            <i class="fas fa-paper-plane mr-3"></i> Update
                        </button>
                    </div>
                </div>
            </div>
        </form>

        
        <div class="card-body px-4">
            <?php if (!$order): ?>
                <div class="alert alert-danger text-center py-4">
                    <i class="fas fa-exclamation-circle fa-2x mb-3"></i>
                    <h4>Order Not Found</h4>
                    <p class="mb-0">The order you're looking for doesn't exist or may have been removed.</p>
                </div>
            <?php else: ?>
                <!-- Status Section -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <!-- Status Update Form (Admin Only) -->
                        <form method="post" class="mb-4 bg-light p-3 rounded">
                            <div class="row g-2 align-items-center">
                                <div class="col-md-5">
                                    <select name="status" class="form-select border-primary">
                                        <option value="Order Confirm" <?= $order['co_status'] == 'Order Confirm' ? 'selected':'' ?>>Processing</option>
                                        <option value="ready" <?= $order['co_status'] == 'ready' ? 'selected':'' ?>>Ready for Shipping</option>
                                        <option value="delivery" <?= $order['co_status'] == 'delivery' ? 'selected':'' ?>>On Delivery</option>
                                        <option value="delivered" <?= $order['co_status'] == 'delivered' ? 'selected':'' ?>>Delivered</option>
                                        <option value="cancelled" <?= $order['co_status'] == 'cancelled' ? 'selected':'' ?>>Cancelled</option>
                                    </select>
                                    <input type="hidden" name="status_id" value="<?= $order['id'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" name="update_status" class="btn btn-primary w-100">
                                        <i class="fas fa-sync-alt me-2"></i>Update Status
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <?php if ($order['coupon']): ?>
                            <div class="badge bg-success bg-opacity-10 text-success p-2">
                                <i class="fas fa-tag me-1"></i> Coupon Applied: <?= htmlspecialchars($order['coupon']) ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Order Items -->
                <div class="mb-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="35%">Product</th>
                                    <th class="text-end">Color</th>
                                    <th class="text-end">Size</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-center">Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total_pay = 0;
                                    foreach ($products as $row_product){
                                        $total_pay = number_format($row_product['total_pay'], 2);
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="upload/<?= htmlspecialchars($row_product['img']) ?>" class="product-img me-3">
                                                    <div>
                                                        <h6 class="mb-1"><?= htmlspecialchars($row_product['name']) ?></h6>
                                                        <small class="text-muted d-block"><?= htmlspecialchars($row_product['type']) ?></small>
                                                        <?php if ($order['co_status'] == 'cancelled'): ?>
                                                            <small class="text-danger"><i class="fas fa-times-circle me-1"></i> Cancelled</small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end align-middle">
                                                <?php
                                                    $colorsArray = explode(",", $row_product['colors']);
                                                    echo htmlspecialchars($colorsArray[$row_product['p_color']] ?? 'N/A');
                                                ?>
                                            </td>
                                            <td class="text-end align-middle">
                                                <?php
                                                    $sizesArray = explode(",", $row_product['sizes']);
                                                    echo htmlspecialchars($sizesArray[$row_product['p_size']] ?? 'N/A');
                                                ?>
                                            </td>
                                            <td class="text-end align-middle"><?= $order['currency']." ".number_format($row_product['item_price'], 2) ?></td>
                                            <td class="text-center align-middle"><?= $row_product['quantity'] ?></td>
                                        </tr>
                                    <?php }
                                ?>
                            </tbody>
                            <tfoot>
                                <!-- <tr class="total-row">
                                    <th colspan="3" class="text-end">Subtotal</th>
                                    <td class="text-end"><= $order['currency']." ".$total_pay ?></td>
                                    <td></td>
                                </tr> -->
                                <?php if ($order['coupon']): ?>
                                <tr>
                                    <th colspan="3" class="text-end">Discount (<?= htmlspecialchars($order['coupon']) ?>)</th>
                                    <td class="text-end text-danger">-<?= $order['currency']." ".number_format($total_pay - $order['amount'], 2) ?></td>
                                    <td></td>
                                </tr>
                                <?php endif; ?>
                                <tr class="total-row">
                                    <th colspan="3" class="text-end">Total <span style="font-size: 11px; font-weight: 500;">(with shipping charge)</span></th>
                                    <td class="text-end fw-bold"><?= $order['currency']." ".number_format($order['amount'], 2) ?></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                <!-- Order Information Cards -->
                <div class="row">
                    <!-- Shipping Address -->
                    <div class="col-lg-6 mb-4">
                        <div class="card info-card h-100">
                            <div class="card-header">
                                <h6 class="mb-0 text-white"><i class="fas fa-map-marker-alt me-2 text-primary"></i> Shipping Address</h6>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-2"><?= htmlspecialchars($order['name']) ?></h6>
                                        <p class="mb-1"><?= nl2br(htmlspecialchars($order['address'])) ?></p>
                                        <p class="mb-1">
                                            <i class="fas fa-phone-alt me-1"></i> <?= htmlspecialchars($order['phone']) ?>
                                        </p>
                                        <p class="mb-0">
                                            <i class="fas fa-envelope me-1"></i> <?= htmlspecialchars($order['email']) ?>
                                        </p>
                                    </div>
                                    <div class="ms-3">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payment Information -->
                    <div class="col-lg-6 mb-4">
                        <div class="card info-card h-100">
                            <div class="card-header">
                                <h6 class="mb-0 text-white"><i class="fas fa-credit-card me-2 text-primary"></i> Payment Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <h6 class="small text-muted mb-1">Payment Method</h6>
                                        <p class="mb-0">
                                            <?php if ($total_pay != 0): ?>
                                                <span class="badge bg-success bg-opacity-10 text-success">
                                                    <i class="fas fa-check-circle me-1"></i> Paid Online
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                                    <i class="fas fa-money-bill-wave me-1"></i> Cash on Delivery
                                                </span>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6 class="small text-muted mb-1">Transaction ID</h6>
                                        <p class="mb-0"><?= $order['transaction_id'] ? htmlspecialchars($order['transaction_id']) : 'N/A' ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="small text-muted mb-1">Order Total</h6>
                                        <h5 class="mb-0"><?= $order['currency'].number_format($order['amount'], 2) ?></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="small text-muted mb-1">Payment Status</h6>
                                        <p class="mb-0">
                                            <span class="badge bg-<?= $products['total_pay'] != 0 ? 'success' : 'warning' ?> bg-opacity-10 text-<?= $products['total_pay'] != 0 ? 'success' : 'warning' ?>">
                                                <?= $products['total_pay'] != 0 ? 'Paid' : 'Pending' ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
// Helper functions
function getStatusColor($status) {
    switch($status) {
        case 'Order Confirm': return 'info';
        case 'ready': return 'warning';
        case 'delivery': return 'primary';
        case 'delivered': return 'success';
        case 'cancelled': return 'danger';
        default: return 'secondary';
    }
}

function getItemStatusColor($status) {
    switch($status) {
        case 'Order Confirm': return 'info';
        case 'shipped': return 'primary';
        case 'delivered': return 'success';
        case 'cancelled': return 'danger';
        case 'returned': return 'warning';
        default: return 'secondary';
    }
}
?>