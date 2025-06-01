<?php
    require_once '../include/dbcon.php';
    if(!isset($_COOKIE['number'])) {
        header("Location: ../auth.php?error=Please+login+first!&refer=".urlencode(encryptSt("cart/index.php")));
        exit();
    }
    if(isset($_GET['remove']) && !empty($_GET['remove'])) {
        $item_id = decryptSt($_GET['remove']);
        $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
        $stmt->bind_param("i", $item_id);
        $stmt->execute();
    }
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
    </head>
    <body>
        <?php
            // Fetch cart items
            $cart = [];
            if (isset($_COOKIE['user_id']) && !empty($_COOKIE['user_id'])) {
                $user_id = decryptSt($_COOKIE['user_id']);
                $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
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
                    $course = $conn->query("SELECT * FROM `$type` WHERE id = $ref_id")->fetch_assoc();
                    ?>
                    <div class="course-item">

                        <img class="course-img" src="<?=htmlspecialchars($course['img'])?>" alt="">
                        <div class="course-info">
                            <div class="course-title"><?=htmlspecialchars($course['title'] ?? $course['name'])?></div>
                            <div class="course-instructor">
                                <?php if ($type === 'product'): ?>
                                    <?=htmlspecialchars($course['type'])?>
                                <?php else: ?>
                                    By <?=htmlspecialchars($course['instructor'])?>
                                <?php endif; ?>
                            </div>
                        </div>
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

                        <div class="course-price">
                            <?php if ($type === 'product'): ?>
                                <div class="quantity-control">
                                    <button type="button" class="qty-btn" onclick="updateQuantity('qty_<?=$item['id']?>', -1, '<?=htmlspecialchars($course['price'])?>', this)">-</button>
                                    <input type="number" id="qty_<?=$item['id']?>"  data-item-id="<?=$item['id']?>" value="<?=htmlspecialchars($item['quantity'] ?? 1)?>" min="1" class="qty-input" readonly />
                                    <button type="button" class="qty-btn" onclick="updateQuantity('qty_<?=$item['id']?>', 1, '<?=htmlspecialchars($course['price'])?>', this)">+</button>
                                </div>
                            <?php endif; ?>
                            <span class="item-price">
                                ৳<span class="price-text"><?=htmlspecialchars($course['price'] * ($item['quantity'] ?? 1))?></span>
                            </span>
                            <a href="?remove=<?=encryptSt($item['id'])?>" class="remove-btn" title="Remove">✖</a>
                        </div>
                    </div>
                    <?php
                } ?>
                </div>
                <form action="checkout_hosted.php" method="POST" class="card summary">
                    <h2>Checkout Summary</h2>
                    <div class="summary-item">
                        <span>Subtotal</span>
                        <span id="subtotal">৳0.00</span>
                    </div>
                    <div class="summary-item" id="discount-row" style="display:none;">
                        <span>Discount <span class="discount-badge" id="discount-code"></span></span>
                        <span style="color: #f72585;" id="discount-amount"></span>
                    </div>
                    <div class="summary-item summary-total">
                        <span>Total</span>
                        <span id="total">৳0.00</span>
                    </div>
                    <div class="coupon-form">
                        <input type="text" class="coupon-input" name="coupon_code" placeholder="Enter coupon code" autocomplete="off" />
                        <button class="coupon-btn" type="button">Apply</button>
                    </div>
                    <button class="checkout-btn" type="submit">Checkout</button>
                    <div style="margin-top: 16px; font-size: 14px; color: var(--text-light); text-align: center;">
                        <p>Secure payment processing</p>
                    </div>
                </form>
                <script>
                    // Example coupon codes
                    const coupons = {
                        'SAVE20': 20,
                        'DISCOUNT10': 10
                    };

                    function calculateSummary(discountValue = 0, code = '') {
                        const itemPrices = document.querySelectorAll('.price-text');
                        let subtotal = 0;
                        itemPrices.forEach(price => {
                            subtotal += parseFloat(price.textContent);
                        });
                        document.getElementById('subtotal').textContent = '৳ ' + subtotal.toFixed(2);

                        let total = subtotal;
                        if (discountValue > 0) {
                            document.getElementById('discount-row').style.display = '';
                            document.getElementById('discount-code').textContent = code;
                            document.getElementById('discount-amount').textContent = '-৳' + discountValue.toFixed(2);
                            total = subtotal - discountValue;
                            if (total < 0) total = 0;
                        } else {
                            document.getElementById('discount-row').style.display = 'none';
                        }
                        document.getElementById('total').textContent = '৳ ' + total.toFixed(2);
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        calculateSummary();
                    });

                    document.querySelector('.coupon-btn').addEventListener('click', function(e) {
                        e.preventDefault();
                        const couponInput = document.querySelector('.coupon-input');
                        const code = couponInput.value.trim().toUpperCase();
                        if (code && coupons[code]) {
                            calculateSummary(coupons[code], code);
                        } else {
                            calculateSummary();
                            if (code) {
                                alert('Invalid coupon code!');
                            }
                        }
                    });
                    function updateQuantity(inputId, change, base_price, button) {
                        button.disabled = true; // Disable button to prevent multiple clicks
                        const input = document.getElementById(inputId);
                        let currentValue = parseInt(input.value);
                        if (isNaN(currentValue)) currentValue = 1;
                        currentValue += change;
                        if(currentValue > 10) currentValue = 10;                        
                        if (currentValue < 1) currentValue = 1;
                        

                        // Update total price
                        const priceText = input.closest('.course-price').querySelector('.price-text');
                        const price = parseFloat(priceText.textContent);
                        const newTotal = currentValue * base_price;

                        fetch("update_quantity.php", {
                            method : "POST",
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                quantity: currentValue,
                                item_id: input.getAttribute('data-item-id')
                            })
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        }).then(data => {
                            if (data.success) {
                                input.value = currentValue;
                                priceText.textContent = newTotal.toFixed(2);
                                calculateSummary();
                            } else {
                                alert('Failed to update quantity!');
                            }
                            button.disabled = false; // Re-enable button after operation
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                            button.disabled = false; // Ensure button is re-enabled on error
                        });
                    }
                </script>
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
                    <button class="browse-courses-btn">Browse Courses</button>
                </div>
            </div>
            <?php }
        ?>
    </body>
</html>
<!-- customer_name=John+Doe&customer_mobile=01711xxxxxx&customer_email=you%40example.com&amount=1200 -->
