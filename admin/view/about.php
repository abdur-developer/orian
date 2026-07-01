<?php
    $sql = "SELECT * FROM about WHERE id = '1'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    
?>

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit About Section</h4>
                <a href="javascript:history.back()" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- <php if ($result->num_rows > 0): ?> -->
            <form action="action/update_about.php" method="POST" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                
                <div class="row g-4">
                    
                    <div class="col-md-6">
                        <!-- name -->
                        <div class="mb-4">
                            <label for="who" class="form-label">
                                <i class="fas fa-align-left me-1 text-muted"></i>আমরা কে
                            </label>
                            <div id="who" style="height: 200px;">
                                <textarea name="who" style="height: 200px; width: 100%;" maxlength="500"><?= $row['who'] ?></textarea>
                            </div>
                            <small class="text-muted">Enter a brief about text (around 500 characters, including spaces and punctuation).</small>
                        </div>
                        <!-- name -->
                        <div class="mb-4">
                            <label for="aim" class="form-label">
                                <i class="fas fa-align-left me-1 text-muted"></i>আমাদের লক্ষ্য 
                            </label>
                            <div id="aim" style="height: 200px;">
                                <textarea name="aim" style="height: 200px; width: 100%;" maxlength="500"><?= $row['aim'] ?></textarea>
                            </div>
                            <small class="text-muted">Enter a brief about text (around 500 characters, including spaces and punctuation).</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- name -->
                        <div class="mb-4">
                            <label for="service" class="form-label">
                                <i class="fas fa-align-left me-1 text-muted"></i>আমরা কী দিই
                            </label>
                            <div id="service" style="height: 200px;">
                                <textarea name="service" style="height: 200px; width: 100%;" maxlength="500"><?= $row['service'] ?></textarea>
                            </div>
                            <small class="text-muted">Enter a brief about text (around 500 characters, including spaces and punctuation).</small>
                        </div>
                        <!-- name -->
                        <div class="mb-4">
                            <label for="why" class="form-label">
                                <i class="fas fa-align-left me-1 text-muted"></i>কেন আমাদের বেছে নেবেন
                            </label>
                            <div id="why" style="height: 200px;">
                                <textarea name="why" style="height: 200px; width: 100%;" maxlength="500"><?= $row['why'] ?></textarea>
                            </div>
                            <small class="text-muted">Enter a brief about text (around 500 characters, including spaces and punctuation).</small>
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