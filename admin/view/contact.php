<?php
    $sql = "SELECT * FROM contact WHERE id = '1'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
?>

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Contact Details</h4>
                <a href="javascript:history.back()" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- <php if ($result->num_rows > 0): ?> -->
            <form action="action/update_contact.php" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <!-- Facebook Link -->
                        <div class="form-floating mb-4">
                            <input type="url" name="facebook" class="form-control" id="facebook" 
                                   value="<?= htmlspecialchars($row['facebook']) ?>" required>
                            <label for="facebook"><i class="fab fa-facebook me-1 text-muted"></i>Facebook</label>
                            <div class="invalid-feedback">Please provide a Facebook link</div>
                        </div>
                        <!-- YouTube Link -->
                        <div class="form-floating mb-4">
                            <input type="url" name="youtube" class="form-control" id="youtube" 
                                   value="<?= htmlspecialchars($row['youtube']) ?>" required>
                            <label for="youtube"><i class="fab fa-youtube me-1 text-muted"></i>YouTube</label>
                            <div class="invalid-feedback">Please provide a YouTube link</div>
                        </div>
                        <!-- TikTok Link -->
                        <div class="form-floating mb-4">
                            <input type="url" name="tiktok" class="form-control" id="tiktok" 
                                   value="<?= htmlspecialchars($row['tiktok']) ?>" required>
                            <label for="tiktok"><i class="fab fa-tiktok me-1 text-muted"></i>TikTok</label>
                            <div class="invalid-feedback">Please provide a TikTok link</div>
                        </div>
                        <!-- Instagram Link -->
                        <div class="form-floating mb-4">
                            <input type="url" name="instagram" class="form-control" id="instagram" 
                                   value="<?= htmlspecialchars($row['instagram']) ?>" required>
                            <label for="instagram"><i class="fab fa-instagram me-1 text-muted"></i>Instagram</label>
                            <div class="invalid-feedback">Please provide an Instagram link</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Location -->
                        <div class="form-floating mb-4">
                            <input type="text" name="location" class="form-control" id="location" 
                                   value="<?= htmlspecialchars($row['location']) ?>" required>
                            <label for="location"><i class="fas fa-map-marker-alt me-1 text-muted"></i>Location</label>
                            <div class="invalid-feedback">Please provide a location</div>
                        </div>
                        <!-- Number -->
                        <div class="form-floating mb-4">
                            <input type="text" name="number" class="form-control" id="number" 
                                   value="<?= htmlspecialchars($row['number']) ?>" required>
                            <label for="number"><i class="fas fa-phone-alt me-1 text-muted"></i>Number</label>
                            <div class="invalid-feedback">Please provide a number</div>
                        </div>
                        <!-- Email -->
                        <div class="form-floating mb-4">
                            <input type="email" name="email" class="form-control" id="email" 
                                   value="<?= htmlspecialchars($row['email']) ?>" required>
                            <label for="email"><i class="fas fa-envelope me-1 text-muted"></i>Email</label>
                            <div class="invalid-feedback">Please provide an email</div>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary px-4" id="submit-btn">
                        <i class="fas fa-save me-1"></i> Update About Section
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