<?php
session_start();
include_once "../include/dbcon.php";
// Login function
function login($email, $password) {
    global $conn;
    $stmt = mysqli_prepare($conn, "SELECT id, password FROM admin WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['login_time'] = time();
        $_SESSION['password_hash'] = $user['password'];

        return true;
    }

    return false;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['password'])) {
    if (login($_POST['email'], $_POST['password'])) {
        header("Location: index.php");
        exit();
    } else {
        header("Location: auth.php?error=Invalid+email+or+password");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In - Admin Panel</title>
  <style>
    :root {
      --primary: #4361ee;
      --primary-dark: #3a56d4;
      --error: #ef233c;
      --light: #f8f9fa;
      --dark: #212529;
      --gray: #6c757d;
      --border: #dee2e6;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
      background-color: #f5f7ff;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      color: var(--dark);
    }
    
    .auth-container {
      width: 100%;
      max-width: 420px;
      padding: 20px;
    }
    
    .auth-card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      padding: 40px;
    }
    
    .auth-header {
      text-align: center;
      margin-bottom: 30px;
    }
    
    .auth-header h2 {
      font-size: 24px;
      font-weight: 600;
      color: var(--dark);
      margin-bottom: 8px;
    }
    
    .auth-form .form-group {
      margin-bottom: 20px;
    }
    
    .auth-form label {
      display: block;
      margin-bottom: 8px;
      font-size: 14px;
      font-weight: 500;
      color: var(--dark);
    }
    
    .auth-form input[type="text"],
    .auth-form input[type="password"] {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid var(--border);
      border-radius: 6px;
      font-size: 15px;
      transition: all 0.3s;
    }
    
    .auth-form input[type="text"]:focus,
    .auth-form input[type="password"]:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    }
    
    .error-message {
      color: var(--error);
      font-size: 13px;
      margin-top: 6px;
    }
    
    .show-password {
      display: flex;
      align-items: center;
      margin-top: 10px;
    }
    
    .show-password input {
      margin-right: 8px;
    }
    
    .show-password label {
      margin-bottom: 0;
      font-weight: 400;
      color: var(--gray);
      cursor: pointer;
    }
    
    .btn {
      width: 100%;
      padding: 12px;
      background-color: var(--primary);
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 15px;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-top: 10px;
    }
    
    .btn:hover {
      background-color: var(--primary-dark);
    }
    
    @media (max-width: 480px) {
      .auth-card {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="auth-container">
    <div class="auth-card">
      <div class="auth-header">
        <h2>Login to Admin Panel</h2>
        <p>Enter your credentials to continue</p>
        <?php if (isset($_REQUEST['error'])): ?>
          <div class="error-message"><?= $_REQUEST['error']; ?></div>
        <?php endif; ?>
      </div>

      <form class="auth-form" method="POST">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="text" id="email" name="email" placeholder="admin@example.com" value="<?= htmlspecialchars($email ?? ''); ?>" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="••••••••" required>
          
          <div class="show-password">
            <input type="checkbox" id="show-password">
            <label for="show-password">Show password</label>
          </div>
        </div>

        <button type="submit" class="btn">Sign In</button>
      </form>
    </div>
  </div>

  <script>
    // Show/hide password functionality
    document.getElementById('show-password').addEventListener('change', function(e) {
      const password = document.getElementById('password');
      password.type = e.target.checked ? 'text' : 'password';
    });
  </script>
</body>
</html>