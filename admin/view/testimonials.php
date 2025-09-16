<?php
    $id = isset($_GET['id']) ? decryptSt($_GET['id']) : null;
    if($id != null){
        $sql = "SELECT * FROM testimonials WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }else{
        $row = [
            'id' => null,
            'name' => null,
            'message' => null,
            'sector' => null,
            'img' => null
        ];
    }
?>

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Testimonial Details</h4>
                <a href="javascript:history.back()" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- <php if ($result->num_rows > 0): ?> -->
            <form action="action/update_testimonials.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- name -->
                        <div class="form-floating mb-4">
                            <input type="text" name="name" class="form-control" id="name" 
                                   value="<?= htmlspecialchars($row['name']) ?>" required>
                            <label for="name"><i class="fas fa-heading me-1 text-muted"></i>Name</label>
                            <div class="invalid-feedback">Please provide a name</div>
                        </div>
                        
                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-image me-1 text-muted"></i>Image</label>
                            <?php if (!empty($row['img'])): ?>
                                <div class="mb-3 text-center">
                                    <?php
                                        $imgSrc = '';
                                        if (!empty($row['img'])) {
                                            if (strpos($row['img'], 'https://randomuser.me/') === 0) {
                                                $imgSrc = htmlspecialchars($row['img']);
                                            } else {
                                                $imgSrc = 'upload/' . htmlspecialchars($row['img']);
                                            }
                                        }
                                    ?>
                                    <img src="<?= $imgSrc ?>" alt="Current Image" 
                                         class="img-thumbnail rounded" style="max-height: 200px;">
                                    </div>
                            <?php endif; ?>
                            <input type="file" name="img" class="form-control" accept="image/*">
                            <small class="text-muted">Max size: 2MB (JPEG, PNG)</small>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        
                        <!-- Deadline -->
                        <div class="form-floating mb-4">
                            <input type="text" name="message" class="form-control" id="message" 
                                   value="<?= htmlspecialchars($row['message']) ?>">
                            <label for="message"><i class="fas fa-message me-1 text-muted"></i>Message</label>
                        </div>
                        
                        <!-- Job Sector -->
                        <div class="form-floating mb-4">
                            <input type="text" name="sector" class="form-control" id="sector" 
                                   value="<?= htmlspecialchars($row['sector']) ?>">
                            <label for="sector"><i class="fas fa-link me-1 text-muted"></i>Job Sector</label>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary px-4" id="submit-btn">
                        <i class="fas fa-save me-1"></i> Update Testimonials
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