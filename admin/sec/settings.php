<style>
    :root {
        --primary-color: #4e73df;
        --success-color: #1cc88a;
        --danger-color: #e74a3b;
    }
    .auth-card {
        max-width: 450px;
        margin: 5% auto;
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        overflow: hidden;
    }
    .auth-header {
        background: var(--primary-color);
        color: white;
        padding: 1.5rem;
        text-align: center;
    }
    .auth-body {
        padding: 2rem;
        background: white;
    }
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }
    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    .password-toggle {
        cursor: pointer;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }
    .input-group {
        position: relative;
    }
</style>
<div class="container">
    <div class="auth-card">
        <div class="auth-header">
            <h4><i class="fas fa-user-shield me-2"></i> Admin Credentials Update</h4>
        </div>
        <div class="auth-body">            
            <form action="" method="post" id="updateForm">
                <?php
                    $sql = "SELECT * FROM admin WHERE id = 1";
                    $admin = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                ?>
                <div class="mb-4">
                    <label for="username" class="form-label">New Username</label>
                    <input type="text" class="form-control" id="username" name="admin-username" autocomplete="off" required 
                            value="<?=$admin['username']?>" placeholder="Enter new username">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">New Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" autocomplete="off" required
                                value="<?= chotoKro($admin['password'], 20)?>" placeholder="Enter new password" minlength="6">
                        <span class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                    <small class="text-muted">Minimum 8 characters</small>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-block py-2">
                        <i class="fas fa-save me-2"></i> Update Credentials
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
        
        if (password.type === 'password') {
            password.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>