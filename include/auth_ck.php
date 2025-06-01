<?php
include 'include/dbcon.php';

function sanitize($conn, $value) {
    return mysqli_real_escape_string($conn, trim($value));
}
function encryptPass($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['number'], $_POST['password'])) {
        header("location: ?error=Missing input!");
        exit();
    }

    $number = sanitize($conn, $_POST['number']);
    $password = $_POST['password']; // Don't sanitize password
    $signup = isset($_POST['signup']) ? (int)$_POST['signup'] : 0;
    $name = isset($_POST['name']) ? sanitize($conn, $_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitize($conn, $_POST['email']) : '';
    $wish = isset($_POST['wish']) ? implode(',', array_map(function($w) use ($conn) {
        return sanitize($conn, $w);
    }, $_POST['wish'])) : '';

    if (strlen($number) < 11) {
        header("location: ?error=Invalid number!");
        exit();
    }
    if (strlen($password) < 6) {
        header("location: ?error=Password must be at least 6 characters!");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE number = ?");
    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($signup === 1) {
        if ($result->num_rows > 0) {
            header("location: ?error=Number already exists!");
            exit();
        }

        $hashedPassword = encryptPass($password);
        $stmt = $conn->prepare("INSERT INTO users (name, number, email, wish, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $number, $email, $wish, $hashedPassword);
        if ($stmt->execute()) {
            $_SESSION['user_id'] = encryptSt($conn->insert_id);
            $_SESSION['number'] = $number;
            $_SESSION['web'] = encryptSt($password);
            header("Location: home.php");
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
                $_SESSION['user_id'] = encryptSt($row['id']);
                $_SESSION['number'] = $number;
                $_SESSION['web'] = encryptSt($password);
                if($_POST['refer'] != 'null') {
                    $refer = decryptSt($_POST['refer']);
                    header("Location: $refer");
                    exit();
                }else {
                    header("Location: home.php");
                    exit();
                }
            } else {
                header("location: ?error=Incorrect password!");
                exit();
            }
        } else {
            header("location: ?error=Invalid credentials!");
            exit();
        }
    }
}


require_once 'include/dbcon.php';
if (isset($_SESSION['number']) && isset($_SESSION['web'])) {
    $number = $_SESSION['number'];
    $web = decryptSt($_SESSION['web']);
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `number` = ?");
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
                header("Location: home.php");
                exit();
            }
        }
    }
}
?>
