<?php
    $id = isset($_GET['id']) ? decryptSt($_GET['id']) : null;
    if($id != null){
        $sql = "SELECT * FROM circulars WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }else{
        $row = [
            'id' => null,
            'title' => null,
            'organization' => null,
            'location' => null,
            'sort_text' => null,
            'img' => null,
            'description' => null,
            'dateline' => null,
            'g_form_link' => null,
            'vacancy' => null
        ];
    }
?>

<!-- Quill CSS -->
<!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Circular Details</h4>
                <a href="javascript:history.back()" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- <php if ($result->num_rows > 0): ?> -->
            <form action="action/update_circular.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                <!-- <input type="hidden" name="description" id="quill-html"> -->
                
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Title -->
                        <div class="form-floating mb-4">
                            <input type="text" name="title" class="form-control" id="title" 
                                   value="<?= htmlspecialchars($row['title']) ?>" required maxlength="225">
                            <label for="title"><i class="fas fa-heading me-1 text-muted"></i>Title</label>
                            <div class="invalid-feedback">Please provide a title</div>
                        </div>
                        
                        <!-- Organization -->
                        <div class="form-floating mb-4">
                            <input type="text" name="organization" class="form-control" id="organization" 
                                   value="<?= htmlspecialchars($row['organization']) ?>" required>
                            <label for="organization"><i class="fas fa-building me-1 text-muted"></i>Organization</label>
                            <div class="invalid-feedback">Please provide an organization name</div>
                        </div>
                        
                        <!-- Location -->
                        <div class="form-floating mb-4">
                            <input type="text" name="location" class="form-control" id="location" 
                                   value="<?= htmlspecialchars($row['location']) ?>" required>
                            <label for="location"><i class="fas fa-map-marker-alt me-1 text-muted"></i>Location</label>
                        </div>
                        
                        <!-- Short Text -->
                        <div class="form-floating mb-4">
                            <input type="text" name="sort_text" class="form-control" id="sort_text" 
                                   value="<?= htmlspecialchars($row['sort_text']) ?>" maxlength="225" required>
                            <label for="sort_text"><i class="fas fa-info-circle me-1 text-muted"></i>Short Text</label>
                        </div>
                        <!-- Description with Quill Editor -->
                        <div class="mb-4">
                            <label for="quill-editor" class="form-label">
                                <i class="fas fa-align-left me-1 text-muted"></i>Description
                            </label>
                            <div id="quill-editor" style="height: 400px;">
                                <textarea id="tiny" name="description" style="height: 300px; width: 100%;" required><?= $row['description'] ?></textarea>
                            </div>
                            <small class="text-muted">Write detailed description with formatting options</small>
                        </div>
                        
                        <!-- Deadline -->
                        <div class="form-floating mb-4">
                            <input type="date" name="dateline" class="form-control" id="dateline" 
                                   value="<?= htmlspecialchars(date('Y-m-d', strtotime($row['dateline']))) ?>" required>
                            <label for="dateline"><i class="fas fa-calendar-alt me-1 text-muted"></i>Deadline</label>
                        </div>
                        
                        <!-- Google Form Link -->
                        <div class="form-floating mb-4">
                            <input type="url" name="g_form_link" class="form-control" id="g_form_link" 
                                   value="<?= htmlspecialchars($row['g_form_link']) ?>" required>
                            <label for="g_form_link"><i class="fas fa-link me-1 text-muted"></i>Google Form Link</label>
                        </div>
                        
                        <!-- Vacancy -->
                        <div class="form-floating mb-4">
                            <input type="number" name="vacancy" class="form-control" id="vacancy" 
                                   value="<?= htmlspecialchars($row['vacancy']) ?>" required>
                            <label for="vacancy"><i class="fas fa-users me-1 text-muted"></i>Vacancy</label>
                        </div>
                        
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Image Upload 1 -->
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-image me-1 text-muted"></i>Circular Image 1</label>
                            <?php if (!empty($row['img'])): ?>
                                <div class="mb-3 text-center">
                                    <img src="upload/<?= htmlspecialchars($row['img']) ?>" alt="Current Image" 
                                         class="img-thumbnail rounded" style="max-height: 200px;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remove_img" id="remove_img" required>
                                        <label class="form-check-label text-danger" for="remove_img">
                                            Remove current image
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <input type="file" name="img" class="form-control" accept="image/*">
                            <small class="text-muted">Max size: 2MB (JPEG, PNG)</small>
                        </div>

                        <!-- Image Upload 2 -->
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-image me-1 text-muted"></i>Circular Image 2</label>
                            <?php if (!empty($row['img_2'])): ?>
                                <div class="mb-3 text-center">
                                    <img src="upload/<?= htmlspecialchars($row['img_2']) ?>" alt="Current Image 2" 
                                         class="img-thumbnail rounded" style="max-height: 200px;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remove_img_2" id="remove_img_2" required>
                                        <label class="form-check-label text-danger" for="remove_img_2">
                                            Remove current image
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <input type="file" name="img_2" class="form-control" accept="image/*">
                            <small class="text-muted">Max size: 2MB (JPEG, PNG)</small>
                        </div>

                        <!-- Image Upload 3 -->
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-image me-1 text-muted"></i>Circular Image 3</label>
                            <?php if (!empty($row['img_3'])): ?>
                                <div class="mb-3 text-center">
                                    <img src="upload/<?= htmlspecialchars($row['img_3']) ?>" alt="Current Image 3" 
                                         class="img-thumbnail rounded" style="max-height: 200px;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remove_img_3" id="remove_img_3" required>
                                        <label class="form-check-label text-danger" for="remove_img_3">
                                            Remove current image
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <input type="file" name="img_3" class="form-control" accept="image/*">
                            <small class="text-muted">Max size: 2MB (JPEG, PNG)</small>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary px-4" id="submit-btn">
                        <i class="fas fa-save me-1"></i> Update Circular
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
                'preview', 'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
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
// quill.root.innerHTML = `<= $row['description'] ?>`;

// // Form submission handler
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