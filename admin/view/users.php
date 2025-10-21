<?php
    $id = isset($_GET['id']) ? decryptSt($_GET['id']) : null;
    if($id != null){
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }else{
        /*
        student_id, name, number, email, password, wish, bio, address, status
        */
        $row = [
            'id' => null,
            'student_id' => null,
            'name' => null,
            'number' => null,
            'email' => null,
            'password' => null,
            'wish' => null, //shdh, sudgvuc, uusdv #separet by comma
            'bio' => null,
            'address' => null,
            'status' => null // 0/1
        ];
    }
?>

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Users Details</h4>
                <a href="javascript:history.back()" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form action="action/update_users.php" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Student ID -->
                        <div class="form-floating mb-4">
                            <input type="text" readonly class="form-control" id="student_id" 
                                   value="<?= htmlspecialchars($row['student_id']) ?>">
                            <label for="student_id"><i class="fas fa-id-card me-1 text-muted"></i>Student ID</label>
                            <div class="invalid-feedback">Please provide a student ID</div>
                        </div>
                        
                        <!-- Name -->
                        <div class="form-floating mb-4">
                            <input type="text" name="name" class="form-control" id="name" 
                                   value="<?= htmlspecialchars($row['name']) ?>" required>
                            <label for="name"><i class="fas fa-user me-1 text-muted"></i>Name</label>
                            <div class="invalid-feedback">Please provide a name</div>
                        </div>
                        
                        <!-- Number -->
                        <div class="form-floating mb-4">
                            <input type="text" name="number" class="form-control" id="number" 
                                   value="<?= htmlspecialchars($row['number']) ?>">
                            <label for="number"><i class="fas fa-phone me-1 text-muted"></i>Phone Number</label>
                        </div>
                        
                        <!-- Email -->
                        <div class="form-floating mb-4">
                            <input type="email" name="email" class="form-control" id="email" 
                                   value="<?= htmlspecialchars($row['email']) ?>" required>
                            <label for="email"><i class="fas fa-envelope me-1 text-muted"></i>Email</label>
                            <div class="invalid-feedback">Please provide a valid email</div>
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-4">
                            <input type="password" name="password" class="form-control" id="password" 
                                   value="<?= htmlspecialchars($row['password']) ?>">
                            <label for="password"><i class="fas fa-lock me-1 text-muted"></i>Password</label>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">                        
                        <!-- Wish -->
                        <div class="form-floating mb-4">
                            <input type="text" name="wish" class="form-control" id="wish" 
                                   value="<?= htmlspecialchars($row['wish']) ?>">
                            <label for="wish"><i class="fas fa-heart me-1 text-muted"></i>Wish (comma separated)</label>
                        </div>
                        
                        <!-- Bio -->
                        <div class="form-floating mb-4">
                            <textarea name="bio" class="form-control" id="bio" style="height: 100px"><?= htmlspecialchars($row['bio']) ?></textarea>
                            <label for="bio"><i class="fas fa-info-circle me-1 text-muted"></i>Bio</label>
                        </div>
                        
                        <!-- Address -->
                        <div class="form-floating mb-4">
                            <textarea name="address" class="form-control" id="address" style="height: 100px"><?= htmlspecialchars($row['address']) ?></textarea>
                            <label for="address"><i class="fas fa-map-marker-alt me-1 text-muted"></i>Address</label>
                        </div>
                        
                        <!-- Status -->
                        <div class="form-floating mb-4">
                            <select name="status" class="form-control" id="status">
                                <option value="1" <?= $row['status'] == 1 ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?= $row['status'] == 0 ? 'selected' : '' ?>>Inactive</option>
                            </select>
                            <label for="status"><i class="fas fa-toggle-on me-1 text-muted"></i>Status</label>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary px-4" id="submit-btn">
                        <i class="fas fa-save me-1"></i> Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
// Form validation
(() => {
  'use strict'
  const forms = document.querySelectorAll('.needs-validation')
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault()
        event.stopPropagation()
      }
      form.classList.add('was-validated')
    }, false)
  })
})();
</script>