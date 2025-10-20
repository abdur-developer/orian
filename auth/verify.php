<?php
    session_start();
    include '../include/dbcon.php';
    $able_reset = false;
    $number = '';
    // exit();
    if(isset($_POST['new_password'])){
        $pass = $_POST['new_password'];
        $number = $_POST['number'];
        
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE number = ?");
        $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
        $stmt->bind_param("ss", $hashedPassword, $number);
        if ($stmt->execute()) {
            // fetch user id by number (insert_id is only for INSERTs)
            $getId = $conn->prepare("SELECT id FROM users WHERE number = ?");
            $getId->bind_param("s", $number);
            $getId->execute();
            $getId->bind_result($user_id);
            $getId->fetch();
            $getId->close();

            if(!empty($user_id)){
                addCookie('user_id', encryptSt($user_id));
            }
            addCookie('number', encryptSt($number));
            addCookie('web', encryptSt($pass));
            header("Location: ../home.php");
            exit();
        } else {
            header("location: ?error=Error: " . $stmt->error);
            exit();
        }
        
    }
    if(isset($_POST['input_otp'])){
        $input_otp = $_POST['input_otp'];
        $otp = decryptSt($_SESSION['otp']);
        if($input_otp == $otp){
            $number = $_SESSION['user_num'];
            unset($_SESSION['otp'], $_SESSION['otp_time'], $_SESSION['user_num']);
            $able_reset = true;            
        }else{
            header("location: verify.php?error=Invalid+OTP+entered!");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification | Auth Securely</title>
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
            padding: 1.5rem;
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
            margin-bottom: 1.5rem;
        }

        .otp-inputs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 1.5rem;
            font-weight: 600;
            border: 2px solid var(--gray-light);
            border-radius: 8px;
            background: var(--white);
            transition: all 0.3s ease;
        }

        .otp-input:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .otp-input.filled {
            border-color: var(--primary);
            background-color: rgba(79, 70, 229, 0.05);
        }

        .timer-container {
            text-align: center;
            margin-bottom: 1.5rem;
            padding: 0.75rem;
            border-radius: 8px;
            background-color: rgba(79, 70, 229, 0.05);
            font-weight: 500;
            color: var(--primary-dark);
        }

        .timer-expired {
            color: var(--error);
            background-color: rgba(239, 68, 68, 0.05);
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

        .submit-btn:disabled {
            background: var(--gray-medium);
            cursor: not-allowed;
            box-shadow: none;
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

        .resend-otp {
            text-align: center;
            margin-top: 1rem;
            color: var(--gray-dark);
        }

        .resend-otp a {
            color: var(--primary);
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
        }

        .resend-otp a:hover {
            text-decoration: underline;
        }

        .resend-otp a.disabled , input[type="text"]:disabled {
            color: var(--gray-medium);
            cursor: not-allowed;
            text-decoration: none;
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
            
            .otp-input {
                width: 45px;
                height: 45px;
                font-size: 1.25rem;
            }
        }

        @media (max-width: 360px) {
            .otp-inputs {
                gap: 0.5rem;
            }
            
            .otp-input {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    <?php
        // Simulating session data for the example
        
        if(isset($_REQUEST['success']) && !$able_reset){
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
        if(isset($_REQUEST['error']) && !$able_reset){
            $error = $_REQUEST['error'];
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Ops...',
                    text: '$error'
                    });
            </script>
            ";
        }
    ?>
    <div class="login-card">
        <div class="card-header">
            <?php
                echo '<h1>ওটিপি যাচাইকরণ</h1>';
                echo '<p>আপনার মোবাইল নম্বরে পাঠানো ৬ ডিজিটের কোডটি প্রবেশ করান</p>';                
            ?>
        </div>
        
        <div class="card-body">
            <form action="" method="POST">
                <?php
                    if($able_reset) include 'reset.php';
                    else include 'otp.php';
                
                ?>
            </form>
        </div>
    </div>
</body>
</html>