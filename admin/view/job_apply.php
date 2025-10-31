<?php
    $id = isset($_GET['id']) ? decryptSt($_GET['id']) : null;
    $parent_id = isset($_GET['parent_id']) ? decryptSt($_GET['parent_id']) : null;
    if($id != null){
        $sql = "SELECT * FROM job_apply WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }else{
        $row = [
            'id' => null,
            'name' => null,
            'details' => null,
            'google_form' => null
        ];
    }
?>

<!-- Quill CSS -->
<!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Job Apply Details</h4>
                <a href="javascript:history.back()" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- <php if ($result->num_rows > 0): ?> -->
            <form action="action/update_job_apply.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                <input type="hidden" name="parent_id" value="<?= htmlspecialchars($parent_id) ?>">
                <!-- <input type="hidden" name="details" id="quill-html"> -->
                
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Name -->
                        <div class="form-floating mb-4">
                            <input type="text" name="name" class="form-control" id="name" 
                                   value="<?= htmlspecialchars($row['name']) ?>" maxlength="50" required>
                            <label for="name"><i class="fas fa-heading me-1 text-muted"></i>Name</label>
                            <div class="invalid-feedback">Please provide a name</div>
                        </div>
                        <!-- Google Form Link -->
                        <div class="form-floating mb-4">
                            <input type="url" name="google_form" class="form-control" id="google_form" 
                                   value="<?= htmlspecialchars($row['google_form']) ?>">
                            <label for="google_form"><i class="fas fa-link me-1 text-muted"></i>Google Form Link</label>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- details with Quill Editor -->
                        <div class="mb-4">
                            <label for="quill-editor" class="form-label">
                                <i class="fas fa-align-left me-1 text-muted"></i> Details
                            </label>
                            <div id="quill-editor" style="height: 400px;">
                                <textarea id="tiny" name="details" style="height: 300px; width: 100%;"><?= $row['details'] ?></textarea>
                            </div>
                            <small class="text-muted">Write detailed details with formatting options</small>
                        </div>
                        
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary px-4" id="submit-btn">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/dt45u81y65w6zsnvtlgdzdqqiifg3zjfsf8angmrgud3u0gp/tinymce/8/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#tiny',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
                'preview', 'anchor', 'searchreplace', 'fullscreen', 'visualblocks',
                'insertdatetime', 'media', 'table', 'emoticons', 'wordcount'
            ],
            toolbar:
                'undo redo | styles | bold italic underline | ' +
                'alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | ' +
                'link image media | code fullscreen preview | forecolor backcolor | ' +
                'charmap emoticons | removeformat preview',
            menubar: 'file edit view insert format tools help'
        });

// Set initial content from database
// quill.root.innerHTML = `<= $row['details'] ?>`;

// Form submission handler
// document.querySelector('form').addEventListener('submit', function(e) {
//     // Get HTML content from Quill and put it in hidden input
//     const quillHtml = document.getElementById('quill-html');
//     quillHtml.value = quill.root.innerHTML;
    
//     // Basic form validation
//     if (!this.checkValidity()) {
//         e.preventDefault();
//         e.stopPropagation();
//     }
//     this.classList.add('was-validated');
// });

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