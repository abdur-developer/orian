<?php
include '../include/dbcon.php';

function sanitize($conn, $value) {
    return mysqli_real_escape_string($conn, trim($value));
}
function sendOTP($number){
    session_start();
    $otp = rand(100000, 999999);
    $message = "(Protisheba) Your OTP for password reset is: $otp";

    if (isset($_SESSION['otp_time']) && (time() - (int)$_SESSION['otp_time']) > 300) {
        unset($_SESSION['otp'], $_SESSION['otp_time'], $_SESSION['user_num']);
    }
    if(isset($_SESSION['user_num']) && $_SESSION['user_num'] != $number){
        unset($_SESSION['otp'], $_SESSION['otp_time'], $_SESSION['user_num']);
    }
    if (!isset($_SESSION['otp'])) {
        $api_key = 'OJSONNUUGT97U9Z';
        $sender_id = '8809601004808';
        $url = "https://api.mimsms.com/api/SmsSending/Send";
        $params = [
            'Apikey' => $api_key,
            'UserName' => 'alaminfiverr548@gmail.com',
            'SenderName' => $sender_id,
            'CampaignId' => 'null',
            'MobileNumber' => '88'.$number,
            'TransactionType' => 'T',
            'Message' => $message
        ];
    
        $url_with_params = $url . '?' . http_build_query($params);
    
        $ch = curl_init($url_with_params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    
        // var_dump($response);
        // exit();
        // OTP পাঠানোর সময়
        $_SESSION['otp'] = encryptSt($otp);
        $_SESSION['otp_time'] = time(); // OTP জেনারেট সময়
        $_SESSION['user_num'] = $number;
    }
    header("location: verify.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['number'])) {
        header("location: ?error=Missing+input!");
        exit();
    }

    $number = sanitize($conn, $_POST['number']);
    $signup = isset($_POST['signup']) ? (int)$_POST['signup'] : 0;
    $forgot = isset($_POST['forgot']) ? (int)$_POST['forgot'] : 0;
    $wish = 'jani na';
    // $wish = isset($_POST['wish']) ? implode(',', array_map(function($w) use ($conn) {
        //     return sanitize($conn, $w);
        // }, $_POST['wish'])) : '';
        
    if (strlen($number) < 11) {
        header("location: ?error=Invalid+number!");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE number = ?");
    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($forgot === 1) {
        if ($result->num_rows === 0) {
            header("location: ?error=Number+not+found!");
            exit();
        }else sendOTP($number);
        exit();
    }
    
    
    $password = $_POST['password']; // Don't sanitize password
    if (strlen($password) < 6) {
        header("location: ?error=Password+must+be+at+least+6+characters!");
        exit();
    }
    
    
    if ($signup === 1) {
        $email = isset($_POST['email']) ? sanitize($conn, $_POST['email']) : '';
        $name = isset($_POST['name']) ? sanitize($conn, $_POST['name']) : '';
        if ($result->num_rows > 0) {
            header("location: ?error=Number+already+exists!");
            exit();
        }

        $stmt = $conn->prepare("INSERT INTO users (name, number, email, wish, password) VALUES (?, ?, ?, ?, ?)");
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt->bind_param("sssss", $name, $number, $email, $wish, $hashedPassword);
        if ($stmt->execute()) {
            addCookie('user_id', encryptSt($conn->insert_id));
            addCookie('number', encryptSt($number));
            addCookie('web', encryptSt($password));
            header("Location: ../home.php");
            exit();
        } else {
            header("location: ?error=Error: " . $stmt->error);
            exit();
        }

    } else {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $db_password = $row['password'];

            if (verifyPassword($password, $db_password)) {
                addCookie('user_id', encryptSt($row['id']));
                addCookie('number', encryptSt($number));
                addCookie('web', encryptSt($password));
                if($_POST['refer'] != 'null') {
                    $refer = decryptSt($_POST['refer']);
                    header("Location: $refer");
                    exit();
                }else {
                    header("Location: ../home.php");
                    exit();
                }
            } else {
                header("location: ?error=Incorrect+password!");
                exit();
            }
        } else {
            header("location: ?error=Invalid+credentials!");
            exit();
        }
    }
}


require_once '../include/dbcon.php';
if (isset($_COOKIE['number']) && isset($_COOKIE['web'])) {
    $number = decryptSt($_COOKIE['number']);
    $web = decryptSt($_COOKIE['web']);
    $stmt = $conn->prepare("SELECT * FROM users WHERE number = ?");
    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        //reverify the password
        if (verifyPassword($web, $user['password'])) {
            if(isset($_GET['refer']) && $_GET['refer'] != 'null') {
                $refer = decryptSt($_GET['refer']);
                header("Location: $refer");
                exit();
            }else {
                header("Location: ../home.php");
                exit();
            }
        }
    }
}
?>
