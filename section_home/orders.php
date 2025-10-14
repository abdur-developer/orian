<style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --success-color: #4cc9f0;
      --light-bg: #f8f9fa;
      --dark-text: #2b2d42;
      --light-text: #8d99ae;
    }
    
    body {
      background-color: #f5f7ff;
      color: var(--dark-text);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .header {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 2rem 0;
      margin-bottom: 2rem;
      border-radius: 0 0 20px 20px;
      box-shadow: 0 4px 20px rgba(67, 97, 238, 0.2);
    }
    
    .purchase-card {
      border: none;
      border-radius: 15px;
      padding: 25px;
      margin-bottom: 25px;
      background: white;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-left: 4px solid var(--primary-color);
    }
    
    .purchase-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .badge-status {
      font-size: 0.85rem;
      padding: 0.4em 1em;
      border-radius: 50px;
      font-weight: 500;
      letter-spacing: 0.5px;
    }
    
    .label {
      font-weight: 600;
      color: var(--light-text);
      font-size: 0.9rem;
    }
    
    .value {
      color: var(--dark-text);
      font-weight: 500;
    }
    
    .order-title {
      color: var(--primary-color);
      font-weight: 600;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
    }
    
    .order-title i {
      margin-right: 10px;
      font-size: 1.2rem;
    }
    
    .divider {
      border-top: 1px dashed #e0e0e0;
      margin: 1rem 0;
    }
    .total-amount {
      font-size: 1.2rem;
      font-weight: 600;
      color: var(--primary-color);
    }
    
</style>

<div class="container pb-5">
    <?php
        $sql = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY id DESC";
        $query = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($query)){?>
        <!-- Order Card -->
        <div class="purchase-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="order-title mb-0"><i class="fas fa-receipt"></i> #<?=$row['transaction_id']?></h5>
                <?php $isSuccess = ($row['status'] == 'success') ? true : false; ?>
                <span class="badge <?=($isSuccess) ? 'bg-success text-success' : 'bg-warning text-warning'?> bg-opacity-10 badge-status">
                    <i class="fas <?=($isSuccess) ? 'fa-check-circle' : 'fa-clock'?> me-1"></i> 
                    <?=($isSuccess) ? 'Completed' : 'Pending'?>
                </span>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="label mb-1">Customer Information</p>
                        <p class="value mb-0"><i class="fas fa-user me-2"></i> <?=$row['name']?></p>
                        <p class="value mb-0"><i class="fas fa-envelope me-2"></i> <?=$row['email']?></p>
                        <p class="value mb-0"><i class="fas fa-phone me-2"></i> <?=$row['phone']?></p>
                        <p class="value"><i class="fas fa-map-marker-alt me-2"></i> <?=$row['address']?></p>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="mb-3">
                        <p class="label mb-2">Order Summary</p>
                        <?php
                            if($row['coupon'] != ''){ ?>
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="label">Discount (<?= $row['coupon'] ?>)</span>
                                    <span class="value text-success">-৳<?php
                                    $sql = "SELECT discount FROM coupons WHERE code = '{$row['coupon']}'";
                                    $couponQuery = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($couponQuery) > 0) {
                                        $couponData = mysqli_fetch_assoc($couponQuery);
                                        echo $couponData['discount'];
                                    } else {
                                        echo '0';
                                    }
                                    ?></span>
                                </div>
                        <?php }
                        ?>
                        
                        <div class="divider"></div>
                        <div class="d-flex justify-content-between">
                            <span class="label fw-bold">Total</span>
                            <span class="total-amount">৳<?=$row['amount']?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========= -->
   <?php } ?>
</div>