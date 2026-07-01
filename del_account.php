<?php
session_start();

require 'include/dbcon.php';

$message = "";

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $number = trim($_POST['number']);
    $password = trim($_POST['password']);

    // Input validation
    if (empty($number) || empty($password)) {
        $message = '<div class="alert alert-warning">Please fill all fields</div>';
    } else {
        // Start transaction
        $conn->begin_transaction();

        try {
            // Get user data with password verification
            $stmt = $conn->prepare("SELECT * FROM users WHERE number = ?");
            $stmt->bind_param("s", $number);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($userData = $result->fetch_assoc()) {
                // Verify password (assuming passwords are hashed)
                if (password_verify($password, $userData['password'])) {
                    // Prepare column names for del_user (same as users table)
                    $columns = implode(", ", array_keys($userData));
                    $placeholders = implode(", ", array_fill(0, count($userData), "?"));
                    $types = str_repeat("s", count($userData)); // All params as strings for simplicity
                    
                    // Archive user - dynamically insert all columns
                    $stmtInsert = $conn->prepare("INSERT INTO del_user ($columns) VALUES ($placeholders)");
                    
                    // Create array of values in the same order as columns
                    $values = array_values($userData);
                    $stmtInsert->bind_param($types, ...$values);
                    $stmtInsert->execute();

                    // Delete from users
                    $stmtDelete = $conn->prepare("DELETE FROM users WHERE id = ?");
                    $stmtDelete->bind_param("i", $userData['id']);
                    $stmtDelete->execute();

                    // Commit transaction
                    $conn->commit();
                    
                    // Clear session
                    session_unset();
                    session_destroy();
                    
                    $message = '<div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> Account deleted successfully. Goodbye!
                    </div>';
                } else {
                    throw new Exception("Invalid credentials");
                }
            } else {
                throw new Exception("Invalid credentials");
            }
        } catch (Exception $e) {
            $conn->rollback();
            $message = '<div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> Invalid mobile number or password
            </div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="bn">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account Deletion | Our Service</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            :root {
                --primary-color: #e74c3c;
                --secondary-color: #f8f9fa;
                --dark-color: #343a40;
            }
            
            body {
                background-color: #f5f5f5;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            
            .delete-card {
                border-radius: 15px;
                border: none;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                transition: transform 0.3s ease;
            }
            
            .delete-card:hover {
                transform: translateY(-5px);
            }
            
            .card-header {
                background: linear-gradient(135deg, var(--primary-color), #c0392b);
                padding: 1.5rem;
                text-align: center;
            }
            
            .delete-icon {
                font-size: 2.5rem;
                margin-bottom: 1rem;
                color: white;
            }
            
            .form-control {
                border-radius: 8px;
                padding: 12px 15px;
                border: 1px solid #ddd;
            }
            
            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 0.25rem rgba(231, 76, 60, 0.25);
            }
            
            .btn-delete {
                background-color: var(--primary-color);
                border: none;
                border-radius: 8px;
                padding: 12px;
                font-weight: 600;
                letter-spacing: 0.5px;
                transition: all 0.3s;
            }
            
            .btn-delete:hover {
                background-color: #c0392b;
                transform: translateY(-2px);
            }
            
            .warning-text {
                color: var(--primary-color);
                font-weight: 500;
            }
            
            .footer-links {
                margin-top: 1.5rem;
                text-align: center;
            }
            
            .footer-links a {
                color: var(--dark-color);
                text-decoration: none;
                margin: 0 10px;
            }
            
            .footer-links a:hover {
                color: var(--primary-color);
            }
        </style>
    </head>
    <body>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="delete-card card">
                        <div class="card-header">
                            <div class="delete-icon">
                                <i class="fas fa-user-times"></i>
                            </div>
                            <h3 class="text-white mb-0">Account Deletion</h3>
                        </div>
                        <div class="card-body p-4">
                            <?php echo $message; ?>
                            
                            <p class="text-muted mb-4">
                                Deleting your account will permanently remove all your data from our system. 
                                This action cannot be undone.
                            </p>
                            
                            <form method="POST" id="deleteForm">
                                
                                <div class="mb-3">
                                    <label for="number" class="form-label">
                                        <i class="fas fa-mobile-alt me-2"></i>Mobile Number
                                    </label>
                                    <input type="text" name="number" id="number" class="form-control" 
                                        placeholder="Enter your registered mobile number" required>
                                </div>
                                
                                <div class="mb-4">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock me-2"></i>Password
                                    </label>
                                    <input type="password" name="password" id="password" class="form-control" 
                                        placeholder="Enter your password" required>
                                </div>
                                
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-delete btn-lg">
                                        <i class="fas fa-trash-alt me-2"></i>Delete My Account
                                    </button>
                                </div>
                                
                                <div class="alert alert-warning">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Warning:</strong> This will permanently delete all your data including:
                                    <ul class="mt-2 mb-0">
                                        <li>Your profile information</li>
                                        <li>All associated data</li>
                                        <li>Account access</li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center py-3">
                            <small class="text-muted">
                                Changed your mind? <a href="auth/">Return to safety</a>
                            </small>
                        </div>
                    </div>
                    
                    <div class="footer-links mt-4">
                        <a href="#"><i class="fas fa-home"></i> Home</a>
                        <a href="#"><i class="fas fa-question-circle"></i> Help</a>
                        <a href="#"><i class="fas fa-shield-alt"></i> Privacy</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Confirm before deletion
            document.getElementById('deleteForm').addEventListener('submit', function(e) {
                if (!confirm('Are you absolutely sure you want to delete your account? This cannot be undone.')) {
                    e.preventDefault();
                }
            });
        </script>
    </body>
</html>