<?php
    include_once "../../include/dbcon.php";

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ../../admin/?q=users&error=Invalid+request');
        exit();
    }

    // Get form data
    $id = $_POST['id'];
    $name = $_POST['name'] ?? null;
    $number = $_POST['number'] ?? null;
    $email = $_POST['email'] ?? null;
    $new_password = $_POST['password'] ?? null;
    $wish = $_POST['wish'] ?? null;
    $bio = $_POST['bio'] ?? null;
    $address = $_POST['address'] ?? null;
    $status = isset($_POST['status']) ? (int)$_POST['status'] : 0;

    // Validate required fields
    if (empty($name) || empty($email)) {
        $error_fields = [];
        if (empty($name)) $error_fields[] = 'Name';
        if (empty($email)) $error_fields[] = 'Email';
        
        $error_message = implode('+,+', $error_fields) . '+are+required+fields';
        header("Location: ../../admin/?e=users" . (!empty($id) ? "&id=" . encryptSt($id) : "") . "&error=" . $error_message);
        exit();
    }

    try {
        // Update or Insert
        if (!empty($id)) {
            // Get current user data to check password
            $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();

            // If new password is provided, hash it, otherwise keep the old one
            $password_hash = !empty($new_password) ? password_hash($new_password, PASSWORD_BCRYPT) : $user['password'];

            $sql = "UPDATE users SET 
                    name = ?, number = ?, email = ?, password = ?,
                    wish = ?, bio = ?, address = ?, status = ? 
                    WHERE id = ?";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssii", 
                $name, $number, $email, $password_hash,
                $wish, $bio, $address, $status, $id
            );
            
            if ($stmt->execute()) {
                $stmt->close();
                header("Location: ../../admin/?e=users&id=" . encryptSt($id) . "&success=User+updated+successfully!");
                exit();
            } else {
                throw new Exception("Database error: " . $stmt->error);
            }
        } else {
            // For new user, password is required
            if (empty($new_password)) {
                header("Location: ../../admin/?e=users&error=Password+is+required+for+new+user");
                exit();
            }

            // Hash the password for new user
            $password_hash = password_hash($new_password, PASSWORD_BCRYPT);

            $sql = "INSERT INTO users 
                    (name, number, email, password, wish, bio, address, status) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssi",
                $name, $number, $email, $password_hash,
                $wish, $bio, $address, $status
            );
            
            if ($stmt->execute()) {
                $new_id = $conn->insert_id;
                $stmt->close();
                header("Location: ../../admin/?e=users&id=" . encryptSt($new_id) . "&success=User+created+successfully!");
                exit();
            } else {
                throw new Exception("Database error: " . $stmt->error);
            }
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        header("Location: ../../admin/?e=users" . (!empty($id) ? "&id=" . encryptSt($id) : "") . "&error=An+error+occurred");
        exit();
    }

    $conn->close();
?>