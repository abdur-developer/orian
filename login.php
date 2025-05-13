<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>auth | Abdur Rahman</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #818cf8;
            --gray-light: #f3f4f6;
            --gray-medium: #9ca3af;
            --gray-dark: #4b5563;
            --white: #ffffff;
            --black: #111827;
            --error: #ef4444;
            --success: #10b981;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Anek Bangla", sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--gray-light);
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(79, 70, 229, 0.05) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(129, 140, 248, 0.05) 0%, transparent 20%);
            padding: 1rem;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: var(--white);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            padding: 1rem;
            text-align: center;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: var(--white);
        }

        .card-header h1 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .card-header p {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 300;
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 0.5rem;
            position: relative;
        }

        /* .form-group label {
            position: absolute;
            left: 1rem;
            top: 1rem;
            color: var(--gray-medium);
            font-size: 0.95rem;
            transition: all 0.3s ease;
            pointer-events: none;
            background: var(--white);
            padding: 0 0.5rem;
        } */

        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid var(--gray-light);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--white);
        }
        .form-group span{
            font-size: 0.8rem;
            color: var(--gray-medium);
            margin-left: 0.5rem;
        }

        .form-group input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-group label {
            font-size: 0.8rem;
            color: var(--primary);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        /* 
        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .remember-me input {
            width: 1rem;
            height: 1rem;
            accent-color: var(--primary);
        } */

        .forgot-password a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .forgot-password a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .submit-btn:hover {
            background: linear-gradient(to right, var(--primary-dark), var(--primary));
            box-shadow: 0 5px 15px rgba(79, 70, 229, 0.3);
        }

        .submit-btn:active {
            transform: scale(0.98);
        }

        .signup-link {
            text-align: center;
            color: var(--gray-dark);
            font-size: 0.95rem;
        }

        .signup-link a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .signup-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        /* Responsive Adjustments */
        @media (max-width: 480px) {
            .login-card {
                border-radius: 12px;
            }
            
            .card-header {
                padding: 1.5rem;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .form-group input {
                padding: 0.9rem;
            }
        }

        @media (max-width: 360px) {
            .form-options {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="card-header">
            <?php
                if (isset($_GET['signup'])) {
                    echo '<h1>যোগদানের জন্য স্বাগতম</h1>';
                    echo '<p>একটি অ্যাকাউন্ট তৈরি করতে রেজিস্টার করুন</p>';
                }else {
                    echo '<h1>ফিরে আসার জন্য স্বাগতম</h1>';
                    echo '<p>আপনার অ্যাকাউন্ট অ্যাক্সেস করতে লগইন করুন</p>';
                }
            ?>
        </div>
        
        <div class="card-body">
            <form action="login.php" method="GET">
                <?php
                    if (isset($_GET['signup'])) {
                        echo '<input type="hidden" name="signup" value="1">';
                    }
                ?>
                <div class="form-group">
                    <label for="number">মোবাইল নাম্বার 
                        <?php
                            if (isset($_GET['signup'])) {
                                echo '<span>(হোয়াটসঅ্যাপ সুপারিশ)</span>';
                            }
                        ?>
                    </label>
                    <input type="number" name="number" id="number" placeholder="নাম্বার প্রবেশ করান" required>
                </div>
                <?php if (isset($_GET['signup'])) { ?>
                <div class="form-group">
                    <label for="email">ইমেইল অ্যাড্রেস</label>
                    <input type="email" name="email" id="email" placeholder="ইমেইল প্রবেশ করান" required>
                </div>
                <!-- Check Box -->
                <style>
                    .checkbox-label {
                        display: block;
                        margin-bottom: 12px;
                        font-weight: 500;
                        color: var(--gray-dark);
                    }

                    .checkbox-group {
                        display: flex;
                        flex-wrap: wrap;
                        gap: 15px;
                    }

                    .checkbox-option {
                        display: flex;
                        align-items: center;
                        position: relative;
                        padding-left: 40px;
                        cursor: pointer;
                        font-size: 15px;
                        user-select: none;
                        color: #000 !important;
                    }

                    .checkbox-option input {
                        position: absolute;
                        opacity: 0;
                        cursor: pointer;
                        height: 0;
                        width: 0;
                    }

                    .checkmark {
                        position: absolute;
                        top: 0;
                        left: 0;
                        height: 20px;
                        width: 20px;
                        background-color:#898989;
                        border-radius: 4px;
                        transition: all 0.2s ease;
                    }

                    .checkbox-option:hover input ~ .checkmark {
                        background-color: #000000;
                    }

                    .checkbox-option input:checked ~ .checkmark {
                        background-color: var(--primary);
                    }

                    .checkmark:after {
                        content: "";
                        position: absolute;
                        display: none;
                    }

                    .checkbox-option input:checked ~ .checkmark:after {
                        display: block;
                    }

                    .checkbox-option .checkmark:after {
                        left: 7px;
                        top: 3px;
                        width: 5px;
                        height: 10px;
                        border: solid white;
                        border-width: 0 2px 2px 0;
                        transform: rotate(45deg);
                    }

                    /* Responsive adjustments */
                    @media (max-width: 480px) {
                        .checkbox-group {
                            flex-direction: column;
                            gap: 10px;
                        }
                    }
                </style>
                <div class="form-group">
                    <label class="checkbox-label">আপনি কোন বাহিনীর প্রস্তুতি নিতে ইচ্ছুক ?</label>
                    <div class="checkbox-group">
                        <div class="col-6">
                            <label class="checkbox-option">
                                <input type="checkbox" name="wish" value="Army">
                                <span class="checkmark"></span> বাংলাদেশ সেনাবাহিনী
                            </label>
                            <label class="checkbox-option">
                                <input type="checkbox" name="wish" value="Air">
                                <span class="checkmark"></span> বাংলাদেশ বিমানবাহিনী
                            </label>
                            <label class="checkbox-option">
                                <input type="checkbox" name="wish" value="Navy">
                                <span class="checkmark"></span> বাংলাদেশ নৌবাহিনী
                            </label>
                            <label class="checkbox-option">
                                <input type="checkbox" name="wish" value="BGB">
                                <span class="checkmark"></span> বাংলাদেশ বর্ডারগার্ড
                            </label>
                        </div>
                        <div class="col-6">
                            <label class="checkbox-option">
                                <input type="checkbox" name="wish" value="Police">
                                <span class="checkmark"></span> বাংলাদেশ পুলিশ
                            </label>
                            <label class="checkbox-option">
                                <input type="checkbox" name="wish" value="Ansar">
                                <span class="checkmark"></span> বাংলাদেশ আনসার
                            </label>
                            <label class="checkbox-option">
                                <input type="checkbox" name="wish" value="Fire">
                                <span class="checkmark"></span> বাংলাদেশ ফায়ার সার্ভিস
                            </label>
                            <label class="checkbox-option">
                                <input type="checkbox" name="wish" value="Others">
                                <span class="checkmark"></span> অন্যান্য
                            </label>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <div class="form-group">
                    <label for="password">পাসওয়ার্ড</label>
                    <input type="text" name="password" id="password" placeholder="পাসওয়ার্ড প্রবেশ করান" required>
                </div>
                
                <?php if (!isset($_GET['signup'])){
                    echo '<div class="form-options">
                        <div class="remember-me"></div>
                        <div class="forgot-password">
                            <a href="#">পাসওয়ার্ড ভুলে গেছেন?</a>
                        </div>
                    </div>';
                }?>
                
                
                <button type="submit" class="submit-btn">
                    <?= (isset($_GET['signup'])) ? "রেজিস্টার" : "প্রবেশ"; ?>
                </button>
                
                <div class="signup-link">
                    <?php
                        if (isset($_GET['signup'])) {
                            echo 'আগে থেকেই আছে ? <a href="login.php">লগইন করুন</a>';
                        } else {
                            echo 'কোন আকাউন্ট নেই ? <a href="login.php?signup">রেজিস্টার করুন</a>';
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>