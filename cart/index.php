<?php
    require_once '../include/dbcon.php';
    if(!isset($_COOKIE['number'])) {
        header("Location: ../auth.php?refer=".urlencode(encryptSt("cart/index.php"))); //error=Please+login+first!&
        exit();
    }
    if(isset($_GET['remove']) && !empty($_GET['remove'])) {
        $item_id = decryptSt($_GET['remove']);
        $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
    }
    $d_discount = 0;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Course Cart Checkout</title>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
        <style>
            :root {
                --primary: #4361ee;
                --primary-dark: #3a56d4;
                --success: #4cc9f0;
                --text: #2b2d42;
                --text-light: #8d99ae;
                --border: #edf2f4;
                --bg: #f8f9fa;
                --white: #ffffff;
                --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                --radius: 12px;
                --radius-sm: 8px;
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: "Inter", sans-serif;
                background-color: var(--bg);
                color: var(--text);
                padding: 20px;
                line-height: 1.5;
            }

            .container {
                max-width: 1200px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: 1fr;
                gap: 24px;
            }

            @media (min-width: 768px) {
                .container {
                    grid-template-columns: 2fr 1fr;
                }
            }

            .card {
                background: var(--white);
                border-radius: var(--radius);
                box-shadow: var(--shadow);
                padding: 24px;
            }

            h2 {
                font-size: 20px;
                font-weight: 600;
                margin-bottom: 24px;
                color: var(--text);
            }

            .course-item {
                display: flex;
                align-items: flex-start;
                gap: 16px;
                padding: 16px 0;
                border-bottom: 1px solid var(--border);
            }

            .course-item:last-child {
                border-bottom: none;
            }

            .course-img {
                width: 80px;
                height: 60px;
                border-radius: var(--radius-sm);
                object-fit: cover;
                background-color: #f0f0f0;
                display: flex;
                align-items: center;
                justify-content: center;
                color: var(--text-light);
                font-size: 12px;
            }

            .course-info {
                flex: 1;
            }

            .course-title {
                font-weight: 500;
                margin-bottom: 4px;
            }

            .course-instructor {
                font-size: 14px;
                color: var(--text-light);
            }

            .course-price {
                font-weight: 600;
                color: var(--primary);
            }

            .summary-item {
                display: flex;
                justify-content: space-between;
                margin-bottom: 12px;
            }

            .summary-total {
                border-top: 1px solid var(--border);
                padding-top: 12px;
                margin-top: 12px;
                font-weight: 600;
                font-size: 18px;
            }

            .coupon-form {
                margin-top: 24px;
                display: flex;
                gap: 8px;
            }

            .coupon-input {
                flex: 1;
                padding: 10px 12px;
                border: 1px solid var(--border);
                border-radius: var(--radius-sm);
                font-size: 14px;
            }

            .coupon-input:focus {
                outline: none;
                border-color: var(--primary);
            }

            .coupon-btn {
                padding: 10px 16px;
                background-color: var(--primary);
                color: white;
                border: none;
                border-radius: var(--radius-sm);
                font-weight: 500;
                cursor: pointer;
                transition: background-color 0.2s;
            }

            .coupon-btn:hover {
                background-color: var(--primary-dark);
            }

            .checkout-btn {
                width: 100%;
                padding: 14px;
                margin-top: 24px;
                background-color: var(--primary);
                color: white;
                border: none;
                border-radius: var(--radius-sm);
                font-weight: 600;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.2s;
            }

            .checkout-btn:hover {
                background-color: var(--primary-dark);
            }

            .empty-cart {
                text-align: center;
                padding: 40px 0;
                color: var(--text-light);
            }

            .discount-badge {
                background-color: #f72585;
                color: white;
                font-size: 12px;
                padding: 2px 8px;
                border-radius: 4px;
                margin-left: 8px;
            }

            @media (max-width: 480px) {
                .coupon-form {
                    flex-direction: column;
                }

                .course-item {
                    flex-direction: column;
                }

                .course-img {
                    width: 100%;
                    height: 120px;
                }
            }
        </style>
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <?php
            if(isset($_REQUEST['msg'])){
                $error = $_REQUEST['msg'];
                echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '$error'
                        });
                </script>
                ";
            }
            $hasProduct = false;
            $hasConsultant = false;
            $hasCourse = false;
        ?>
        <?php
            // Fetch cart items
            $cart = [];
            if (isset($_COOKIE['user_id']) && !empty($_COOKIE['user_id'])) {
                $user_id = decryptSt($_COOKIE['user_id']);
                $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND is_running = 1");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $cart = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
            }else {
                // send to auth page if not logged in
                echo '<script>
                    window.location.href = "../auth.php?refer=' . urlencode(encryptSt("cart/index.php")) . '";
                </script>';
            }
            $count = count($cart);

            if ($count > 0) {
                echo '<div class="container">
                    <div class="card cart">';
                echo "<h2>Your Cart ($count " . ($count === 1 ? "item" : "items") . ")</h2>";
                foreach ($cart as $item) {
                    $type = $item['type'];
                    $ref_id = $item['ref_id'];
                    $type_row = $conn->query("SELECT * FROM $type WHERE id = $ref_id")->fetch_assoc();
                ?>
                    <div class="course-item">
                        <img class="course-img" src="../admin/upload/<?=htmlspecialchars($type_row['img'])?>" alt="">
                        <div class="course-info">
                            <div class="course-title"><?=htmlspecialchars($type_row['title'] ?? $type_row['name'])?></div>
                            <div class="course-instructor">
                                <?php
                                    if ($type === 'product'): 
                                        $hasProduct = true;
                                        echo htmlspecialchars($type_row['type']);
                                    elseif ($type === 'consultant'): 
                                        $hasConsultant = true;
                                        echo "By Instructor";
                                    else: 
                                        $hasCourse = true;
                                        echo "By" . htmlspecialchars($type_row['instructor']);
                                    endif;
                                ?>
                            </div>
                        </div>
                        <style>
                            @media screen and (max-width: 576px) {
                                .variant-selector, .course-price{
                                    width: 100%;
                                    display: flex;
                                    justify-content: space-between;
                                }
                            }
                            .variant-title {
                                font-size: 14px;
                                font-weight: 600;
                                margin-bottom: 8px;
                                color: #333;
                            }
                            .variant-options {
                                display: flex;
                                flex-wrap: wrap;
                                gap: 8px;
                            }
                            .variant-option {
                                position: relative;
                            }
                            .variant-input {
                                position: absolute;
                                opacity: 0;
                            }
                            .variant-label {
                                display: inline-block;
                                padding: 2px 4px;
                                border: 2px solid #ddd;
                                border-radius: 6px;
                                font-size: 12px;
                                font-weight: 500;
                                cursor: pointer;
                                transition: all 0.3s ease;
                                background: #fff;
                            }
                            .color-label {
                                text-align: center;
                            }
                            .size-label {
                                text-align: center;
                            }
                            .variant-input:checked + .variant-label {
                                border-color: #007bff;
                                background-color: #007bff;
                                color: white;
                            }
                            .variant-input:checked + .color-label {
                                border-color: #333;
                            }
                            .variant-input:checked + .size-label {
                                border-color: #007bff;
                            }
                            .variant-label:hover {
                                border-color: #999;
                            }
                        </style>
                        <?php
                        if($type == 'product' && $type_row['type'] == 2){ // only for Clothing 
                            $colorsArray = explode(",", $type_row['colors']);
                            $sizesArray = explode(",", $type_row['sizes']);
                        ?>
                            <!-- Cloth Color -->
                            <div class="variant-selector">
                                <div class="variant-title">Color:</div>
                                <div class="variant-options">
                                    <?php foreach($colorsArray as $index => $color): ?>
                                        <div class="variant-option" data-column="p_color" data-item-id="<?=$type_row['id']?>">
                                            <input type="radio" id="color_<?=$color.$type_row['id']?>" name="color_<?=$type_row['id']?>" value="<?=$index?>" class="variant-input" <?= $index == 0 ? "checked": ""?>>
                                            <label for="color_<?=$color.$type_row['id']?>" class="variant-label color-label"><?=$color?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <!-- Cloth Size -->
                            <div class="variant-selector">
                                <div class="variant-title">Size:</div>
                                <div class="variant-options">
                                    <?php foreach($sizesArray as $index => $size): ?>
                                        <div class="variant-option"  data-column="p_size" data-item-id="<?=$type_row['id']?>">
                                            <input type="radio" id="size_<?=$size.$type_row['id']?>" name="size_<?=$type_row['id']?>" value="<?=$index?>" class="variant-input" <?= $index == 0 ? "checked": ""?>>
                                            <label for="size_<?=$size.$type_row['id']?>" class="variant-label size-label"><?=$size?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            
                        <?php } ?>

                        <div class="course-price">
                            <?php if ($type == 'product'): 
                                if($d_discount < $type_row['d_discount']) $d_discount = $type_row['d_discount'];
                                ?>
                                <style>
                                    .quantity-control {
                                        display: flex;
                                        align-items: center;
                                        gap: 4px;
                                    }
                                    .qty-btn {
                                        padding: 4px 10px;
                                        border: 1px solid #ddd;
                                        border-radius: 4px;
                                        font-size: 14px;
                                        cursor: pointer;
                                        transition: all 0.2s ease;
                                        color: #555;
                                        font-weight: 900;
                                    }
                                    .qty-btn:hover {
                                        background: #eee;
                                        border-color: #ccc;
                                    }
                                    .qty-input {
                                        width: 40px;
                                        text-align: center;
                                        border: 1px solid #ddd;
                                        border-radius: 4px;
                                        font-size: 14px;
                                        padding: 4px 0;
                                        -moz-appearance: textfield;
                                    }
                                    .qty-input::-webkit-outer-spin-button,
                                    .qty-input::-webkit-inner-spin-button {
                                        -webkit-appearance: none;
                                        margin: 0;
                                    }
                                    .item-price {
                                        display: inline-block;
                                        margin-top: 10px;
                                        font-weight: bold;
                                        color: #333;
                                    }
                                    .remove-btn {
                                        display: inline-block;
                                        text-decoration: none;
                                        margin-left: 40px;
                                        color: red;
                                        font-size: 14px;
                                        transition: color 0.2s ease;
                                    }
                                    .remove-btn:hover {
                                        color: #e74c3c;
                                    }
                                    .qty-btn:first-child {
                                        background:rgb(255, 124, 124);
                                    }
                                    .qty-btn:last-child {
                                        background:rgb(124, 255, 124);
                                    }
                                </style>
                                <div class="quantity-control">
                                    <button type="button" class="qty-btn" onclick="updateQuantity('qty_<?=$item['id']?>', -1, '<?=htmlspecialchars($type_row['price'])?>', this)">-</button>
                                    <input type="number" id="qty_<?=$item['id']?>"  data-item-id="<?=$item['id']?>" value="<?=htmlspecialchars($item['quantity'] ?? 1)?>" min="1" class="qty-input" readonly />
                                    <button type="button" class="qty-btn" onclick="updateQuantity('qty_<?=$item['id']?>', 1, '<?=htmlspecialchars($type_row['price'])?>', this)">+</button>
                                </div>
                            <?php endif; ?>
                            <span class="item-price">
                                ৳<span class="price-text"><?=htmlspecialchars($type_row['price'] * ($item['quantity'] ?? 1))?></span>
                            </span>
                            <a href="?remove=<?=encryptSt($item['id'])?>" class="remove-btn" title="Remove">✖</a>
                        </div>
                    </div>
                    <?php
                }
                ?>
                </div>
                <form action="checkout_hosted.php" method="POST" class="card summary">
                    <h2>Checkout Summary</h2>
                    <div class="summary-item">
                        <span>Subtotal</span>
                        <span id="subtotal">৳0.00</span>
                    </div>
                    <style>
                        input[name="delivery_amount"]{
                            width: 70px;
                            padding: 0;
                            margin: 0;
                            text-align: center;
                        }
                    </style>
                    <div class="summary-item" id="discount-row" style="display:none;">
                        <span>Discount <span class="discount-badge" id="discount-code"></span></span>
                        <span style="color: #f72585;" id="discount-amount"></span>
                    </div>
                    <?php if ($hasProduct) : ?>
                        <style>
                            .address-selector {
                                display: flex;
                                gap: 10px;
                                margin-bottom: 5px;
                            }
                            
                            .address-option {
                                position: relative;
                                flex: 1;
                                max-width: 180px;
                            }
                            
                            .address-option input {
                                position: absolute;
                                opacity: 0;
                                width: 0;
                                height: 0;
                            }
                            
                            .address-option label span{
                                font-weight: 300;
                                font-size: 10px;
                            }
                            .address-option label {
                                display: block;
                                padding: 2px 5px;
                                border: 2px solid #e0e0e0;
                                border-radius: 8px;
                                background: #f8f8f8;
                                color: #555;
                                font-size: 12px;
                                font-weight: 600;
                                text-align: center;
                                cursor: pointer;
                                transition: all 0.3s ease;
                            }
                            
                            .address-option input:checked + label {
                                border-color: #4a90e2;
                                background: #f0f7ff;
                                color: #4a90e2;
                                box-shadow: 0 2px 8px rgba(74, 144, 226, 0.2);
                            }
                            
                            .address-option input:focus + label {
                                outline: 2px solid #4a90e2;
                                outline-offset: 2px;
                            }
                            
                            .address-option:hover label {
                                border-color: #c0c0c0;
                            }
                            .form-control{
                                width: 100%;
                                padding: 10px;
                                border: 1px solid #ccc;
                                border-radius: 5px;
                                background-color: #f8f8f8;
                                font-size: 16px;
                                color: #333;
                                appearance: none; /* Removes default browser styling */
                                -webkit-appearance: none; /* For WebKit browsers */
                                -moz-appearance: none; /* For Firefox */
                            }
                        </style>
                        <?php
                            $sql = "SELECT * FROM system_structure WHERE id = 1";
                            $result = $conn->query($sql);
                            $str = $result->fetch_assoc();
                        ?>
                        <!-- Delivery address option -->
                        <div class="address-selector">
                            <div class="address-option">
                                <input type="radio" id="inside" name="ck_hub" amount="<?=htmlspecialchars($str['inside'] - $d_discount)?>" disabled>
                                <label for="inside">Inside <?=$str['center']. ' - <span>' . htmlspecialchars($str['inside'] - $d_discount) . ' tk</span>'?></label>
                            </div>
                            <div class="address-option">
                                <input type="radio" id="outside" name="ck_hub" amount="<?=htmlspecialchars($str['outside'] - $d_discount)?>" disabled>
                                <label for="outside">Outside <?=$str['center']. ' - <span>' . htmlspecialchars($str['outside'] - $d_discount) . ' tk</span>'?></label>
                            </div>
                        </div>
                        <div class="coupon-form">
                            <select name="district" class="form-control" id="district_select" data-hub ="<?=$str['center']?>" required >
                                <option value="" selected disabled>Select your District</option>
                                <option value="Bagerhat">Bagerhat</option>
                                <option value="Bandarban">Bandarban</option>
                                <option value="Barguna">Barguna</option>
                                <option value="Barisal">Barisal</option>
                                <option value="Bhola">Bhola</option>
                                <option value="Bogra">Bogra</option>
                                <option value="Brahmanbaria">Brahmanbaria</option>
                                <option value="Chandpur">Chandpur</option>
                                <option value="Chittagong">Chittagong</option>
                                <option value="Chuadanga">Chuadanga</option>
                                <option value="Comilla">Comilla</option>
                                <option value="Cox'sBazar">Cox'sBazar</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Dinajpur">Dinajpur</option>
                                <option value="Faridpur">Faridpur</option>
                                <option value="Feni">Feni</option>
                                <option value="Gaibandha">Gaibandha</option>
                                <option value="Gazipur">Gazipur</option>
                                <option value="Gopalganj">Gopalganj</option>
                                <option value="Habiganj">Habiganj</option>
                                <option value="Jaipurhat">Jaipurhat</option>
                                <option value="Jamalpur">Jamalpur</option>
                                <option value="Jessore">Jessore</option>
                                <option value="Jhalokati">Jhalokati</option>
                                <option value="Jhenaidah">Jhenaidah</option>
                                <option value="Khagrachari">Khagrachari</option>
                                <option value="Khulna">Khulna</option>
                                <option value="Kishoreganj">Kishoreganj</option>
                                <option value="Kurigram">Kurigram</option>
                                <option value="Kushtia">Kushtia</option>
                                <option value="Lakshmipur">Lakshmipur</option>
                                <option value="Lalmonirhat">Lalmonirhat</option>
                                <option value="Madaripur">Madaripur</option>
                                <option value="Magura">Magura</option>
                                <option value="Manikganj">Manikganj</option>
                                <option value="Maulvibazar">Maulvibazar</option>
                                <option value="Meherpur">Meherpur</option>
                                <option value="Munshiganj">Munshiganj</option>
                                <option value="Mymensingh">Mymensingh</option>
                                <option value="Naogaon">Naogaon</option>
                                <option value="Narail">Narail</option>
                                <option value="Narayanganj">Narayanganj</option>
                                <option value="Narsingdi">Narsingdi</option>
                                <option value="Natore">Natore</option>
                                <option value="Nawabganj">Nawabganj</option>
                                <option value="Netrokona">Netrokona</option>
                                <option value="Nilphamari">Nilphamari</option>
                                <option value="Noakhali">Noakhali</option>
                                <option value="Pabna">Pabna</option>
                                <option value="Panchagarh">Panchagarh</option>
                                <option value="Patuakhali">Patuakhali</option>
                                <option value="Pirojpur">Pirojpur</option>
                                <option value="Rajbari">Rajbari</option>
                                <option value="Rajshahi">Rajshahi</option>
                                <option value="Rangamati">Rangamati</option>
                                <option value="Rangpur">Rangpur</option>
                                <option value="Satkhira">Satkhira</option>
                                <option value="Shariatpur">Shariatpur</option>
                                <option value="Sherpur">Sherpur</option>
                                <option value="Sirajganj">Sirajganj</option>
                                <option value="Sunamganj">Sunamganj</option>
                                <option value="Sylhet">Sylhet</option>
                                <option value="Tangail">Tangail</option>
                                <option value="Thakurgaon">Thakurgaon</option>
                            </select>
                        </div>
                        
                        
                        <div class="coupon-form">
                            <textarea class="coupon-input" name="address" placeholder="Enter Address" autocomplete="off" required rows="2" maxlength="200" style="resize:vertical; min-height:40px; max-height:60px; line-height:1.4;"></textarea>
                        </div>
                    <?php endif; ?>
                    <div class="coupon-form">
                        <input type="text" class="coupon-input" id="coupon-input" name="coupon_code" placeholder="Enter coupon code" autocomplete="off" />
                        <button class="coupon-btn" type="button">Apply</button>
                    </div>
                    <div class="summary-item summary-total">
                        <span>Total</span>
                        <span id="total">৳0.00</span>
                    </div>

                    
                    <?php if ($hasConsultant || $hasCourse): ?>
                        <label for="ssl" style="font-size: 14px; color: var(--text-light);">
                            <input type="radio" name="cod" id="ssl" checked>
                            Online payment (SSLCommerz)
                        </label>
                    <?php elseif($hasProduct): ?>
                        <label for="cod" style="font-size: 14px; color: var(--text-light);">
                            <input type="radio" name="cod" id="cod" value="555" checked>
                            Cash on Delivery (COD)
                        </label>
                        <br>
                        <label for="ssl" style="font-size: 14px; color: var(--text-light);">
                            <input type="radio" name="cod" id="ssl" disabled>
                            Online payment (SSLCommerz)
                        </label>
                    <?php endif; ?>

                    <button class="checkout-btn" type="submit">Checkout</button>
                    <div style="margin-top: 16px; font-size: 14px; color: var(--text-light); text-align: center;">
                        <p>Secure payment processing</p>
                    </div>
                </form>
            </div>
            <?php
            } else { ?>
            <div class="container" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
                <style>
                    .empty-cart-state {
                        text-align: center;
                        padding: 40px 20px;
                        background: white;
                        border-radius: var(--radius);
                        box-shadow: var(--shadow);
                        margin: 0 auto;
                        width: 100%;
                    }
                    .empty-cart-icon {
                        margin-bottom: 24px;
                    }
                    .empty-cart-icon svg {
                        width: 80px;
                        height: 80px;
                    }
                    .empty-cart-state h3 {
                        font-size: 20px;
                        font-weight: 600;
                        margin-bottom: 12px;
                        color: var(--text);
                    }
                    .empty-cart-message {
                        color: var(--text-light);
                        margin-bottom: 24px;
                        font-size: 16px;
                    }
                    .browse-courses-btn {
                        padding: 12px 24px;
                        background-color: var(--primary);
                        color: white;
                        border: none;
                        border-radius: var(--radius-sm);
                        font-weight: 500;
                        cursor: pointer;
                        transition: background-color 0.2s;
                        font-size: 16px;
                    }
                    .browse-courses-btn:hover {
                        background-color: var(--primary-dark);
                    }
                </style>
                <div class="empty-cart-state">
                    <div class="empty-cart-icon">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8 4L6 8H18L16 4H8Z" fill="#CBD5E1" stroke="#64748B" stroke-width="1.5"/>
                            <path d="M6 8L4.5 11.5L3.5 16H20.5L19.5 11.5L18 8H6Z" fill="#F1F5F9" stroke="#64748B" stroke-width="1.5"/>
                            <path d="M9 11L12 14L15 11" stroke="#64748B" stroke-width="1.5" stroke-linecap="round"/>
                            <circle cx="9" cy="19" r="1" fill="#64748B"/>
                            <circle cx="15" cy="19" r="1" fill="#64748B"/>
                        </svg>
                    </div>
                    <h3>Your cart is empty</h3>
                    <p class="empty-cart-message">Looks like you haven't added any courses yet.</p>
                    <button class="browse-courses-btn" onclick="location.href=&quot;../home.php?page=courses&quot;">Browse Courses</button>
                </div>
            </div>
            <?php }
        ?>
        <script src="script.js"></script>
        <!-- Script to handle variant selection -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelectorAll('.variant-option').forEach(item => {
                    let column = item.getAttribute('data-column');
                    let itemId = item.getAttribute('data-item-id');
                    let input = item.querySelector('input');

                    item.addEventListener('click', () => {
                        item.disabled = true;
                        let value = input.value;
                        fetch('update_column.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({ table: 'cart', column: column, value: value, item_id: itemId })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Update successful:');
                            } else {
                                console.error('Update failed:');
                                alert('Failed to update. Please try again.');
                            }
                            item.disabled = false;
                        });
                    });
                });
            });
        </script>
    </body>
</html>

