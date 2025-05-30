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
        <div class="container">
            <div class="card cart">
                <h2>Your Learning Cart (3 courses)</h2>

                <div class="course-item">
                    <div class="course-img">Web Dev</div>
                    <div class="course-info">
                        <div class="course-title">Web Development Bootcamp</div>
                        <div class="course-instructor">By Alex Johnson</div>
                    </div>
                    <div class="course-price">$49.99</div>
                </div>

                <div class="course-item">
                    <div class="course-img">Data Sci</div>
                    <div class="course-info">
                        <div class="course-title">Data Science with Python</div>
                        <div class="course-instructor">By Sarah Miller</div>
                    </div>
                    <div class="course-price">$59.99</div>
                </div>

                <div class="course-item">
                    <div class="course-img">UI/UX</div>
                    <div class="course-info">
                        <div class="course-title">UI/UX Design Masterclass</div>
                        <div class="course-instructor">By David Chen</div>
                    </div>
                    <div class="course-price">$39.99</div>
                </div>
            </div>
            <form action="checkout_hosted.php" class="card summary">
                <h2>Order Summary</h2>

                <div class="summary-item">
                    <span>Subtotal</span>
                    <span>$149.97</span>
                </div>

                <div class="summary-item">
                    <span>Discount <span class="discount-badge">SAVE20</span></span>
                    <span style="color: #f72585;">-$20.00</span>
                </div>

                <div class="summary-item summary-total">
                    <span>Total</span>
                    <span>$129.97</span>
                </div>

                <div class="coupon-form">
                    <input type="text" class="coupon-input" name="coupon_code" placeholder="Enter coupon code" />
                    <button class="coupon-btn">Apply</button>
                </div>

                <button class="checkout-btn" type="submit"> Checkout</button>

                <div style="margin-top: 16px; font-size: 14px; color: var(--text-light); text-align: center;">
                    <p>Secure payment processing</p>
                </div>
            </form>
        </div>
        <!-- <div class="container" style="display: flex; justify-content: center; align-items: center; height: 100vh;"> 
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
        </div> -->
    </body>
</html>
<!-- customer_name=John+Doe&customer_mobile=01711xxxxxx&customer_email=you%40example.com&amount=1200 -->
