<?php require 'auth_ck.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>auth securely</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    <?php
        if(isset($_REQUEST['success'])){
            $success = $_REQUEST['success'];
            echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'WOW...',
                    text: '$success'
                    });
            </script>
            ";
        }
        if(isset($_REQUEST['error'])){
            $error = $_REQUEST['error'];
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'WOW...',
                    text: '$error'
                    });
            </script>
            ";
        }
    ?>
    <div class="login-card">
        <div class="card-header">
            <?php
                if (isset($_GET['signup'])) {
                    echo '<h1>যোগদানের জন্য স্বাগতম</h1>';
                    echo '<p>একটি অ্যাকাউন্ট তৈরি করতে রেজিস্টার করুন</p>';
                    echo '<p>
                            ১) নতুন হলে অবশ্যই ইউজার আইডি এবং পাসওয়ার্ড মনে রাখবেন, দয়া করে নোট করে রাখুন। <br>
                            ২) ইউজার আইডি বা পাসওয়ার্ড ভুলে গেলে ফরগেট পাসওয়ার্ড দিয়ে রিসেট করে নিন।
                        </p>';
                }elseif(isset($_GET['forgot'])){
                    echo '<h1>ফিরে আসার জন্য স্বাগতম</h1>';
                    echo '<p>প্রথমে আপনার নম্বরটি যাচাই করতে হবে, </p>';
                }else {
                    echo '<h1>ফিরে আসার জন্য স্বাগতম</h1>';
                    echo '<p>আমাদের এই সেবাগুলো গ্রহণ করার জন্য আপনাকে প্রথমে লগইন করতে হবে। </p>';
                }
            ?>
        </div>
        
        <div class="card-body">
            <form action="" method="POST">
                <?php 
                    if(isset($_GET['forgot'])) require 'forgot.php';
                    elseif(isset($_GET['signup'])) require 'signup.php';
                    else require 'signin.php';
                 ?>
                
            </form>
        </div>
    </div>
</body>
</html>