<?php
    $id = isset($_GET['id']) ? decryptSt($_GET['id']) : null;
    if($id != null){
        $sql = "SELECT * FROM post WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }else{
        $row = [
            'id' => null,
            'title' => null,
            'category' => null,
            'sort_text' => null,
            'img' => null,
            'text' => null,
            'tags' => null,
            'date' => null
        ];
    }
?>

<!-- Quill CSS -->
<!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Post Details</h4>
                <a href="javascript:history.back()" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- <php if ($result->num_rows > 0): ?> -->
            <form action="action/update_post.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                <!-- <input type="hidden" name="text" id="quill-html"> -->
                
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Title -->
                        <div class="form-floating mb-4">
                            <input type="text" name="title" class="form-control" id="title" 
                                   value="<?= htmlspecialchars($row['title']) ?>" required>
                            <label for="title"><i class="fas fa-heading me-1 text-muted"></i>Title</label>
                            <div class="invalid-feedback">Please provide a title</div>
                        </div>
                        
                        <!-- Category -->
                        <div class="form-floating mb-4">
                            <input type="text" name="category" class="form-control" id="category" 
                                   value="<?= htmlspecialchars($row['category']) ?>" required>
                            <label for="category"><i class="fas fa-building me-1 text-muted"></i>Category</label>
                            <div class="invalid-feedback">Please provide an category name</div>
                        </div>
                                                
                        <!-- Short Text -->
                        <div class="form-floating mb-4">
                            <input type="text" name="sort_text" class="form-control" id="sort_text" 
                                   value="<?= htmlspecialchars($row['sort_text']) ?>" required maxlength="225">
                            <label for="sort_text"><i class="fas fa-info-circle me-1 text-muted"></i>Short Text</label>
                        </div>
                        
                        <!-- Description with Quill Editor -->
                        <div class="mb-4">
                            <label for="quill-editor" class="form-label">
                                <i class="fas fa-align-left me-1 text-muted"></i>Description
                            </label>
                            <div id="quill-editor" style="height: 300px;">
                                <textarea name="text" style="height: 300px; width: 100%;" required><?= $row['text'] ?></textarea>
                            </div>
                            <small class="text-muted">Write detailed text with formatting options</small>
                        </div>
                        
                        <!-- Date -->
                        <div class="form-floating mb-4">
                            <input type="date" name="date" class="form-control" id="date" 
                                   value="<?= htmlspecialchars(date('Y-m-d', strtotime($row['date']))) ?>" required>
                            <label for="date"><i class="fas fa-calendar-alt me-1 text-muted"></i>Date</label>
                        </div>
                        
                        <!-- tags -->
                        <div class="form-floating mb-4">
                            <input type="text" name="tags" class="form-control" id="tags" 
                                   value="<?= htmlspecialchars($row['tags']) ?>" required>
                            <label for="tags"><i class="fas fa-users me-1 text-muted"></i>Tags (separate by comma)</label>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-image me-1 text-muted"></i>Post Image</label>
                            <?php if (!empty($row['img'])): ?>
                                <div class="mb-3 text-center">
                                    <img src="upload/<?= htmlspecialchars($row['img']) ?>" alt="Current Image" 
                                         class="img-thumbnail rounded" style="max-height: 200px;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remove_img" id="remove_img">
                                        <label class="form-check-label text-danger" for="remove_img">
                                            Remove current image
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <input type="file" name="img" class="form-control" accept="image/*" required>
                            <small class="text-muted">Max size: 2MB (JPEG, PNG)</small>
                        </div>
                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-image me-1 text-muted"></i>Post Image</label>
                            <?php if (!empty($row['img_2'])): ?>
                                <div class="mb-3 text-center">
                                    <img src="upload/<?= htmlspecialchars($row['img_2']) ?>" alt="Current Image" 
                                         class="img-thumbnail rounded" style="max-height: 200px;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remove_img_2" id="remove_img_2">
                                        <label class="form-check-label text-danger" for="remove_img_2">
                                            Remove current image
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <input type="file" name="img_2" class="form-control" accept="image/*" required>
                            <small class="text-muted">Max size: 2MB (JPEG, PNG)</small>
                        </div>
                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-image me-1 text-muted"></i>Post Image</label>
                            <?php if (!empty($row['img_3'])): ?>
                                <div class="mb-3 text-center">
                                    <img src="upload/<?= htmlspecialchars($row['img_3']) ?>" alt="Current Image" 
                                         class="img-thumbnail rounded" style="max-height: 200px;">
                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="checkbox" name="remove_img_3" id="remove_img_3">
                                        <label class="form-check-label text-danger" for="remove_img_3">
                                            Remove current image
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <input type="file" name="img_3" class="form-control" accept="image/*" required>
                            <small class="text-muted">Max size: 2MB (JPEG, PNG)</small>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary px-4" id="submit-btn">
                        <i class="fas fa-save me-1"></i> Update Post
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Quill JS -->
<!-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> -->
<script>
// Initialize Quill Editor
// const quill = new Quill('#quill-editor', {
//     theme: 'snow',
//     modules: {
//         toolbar: [
//             [{ 'header': [1, 2, 3, false] }],
//             [{ 'align': [] }],
//             ['bold', 'italic', 'underline', 'strike'],
//             [{ 'color': [] }, { 'background': [] }],
//             [{ 'list': 'ordered'}, { 'list': 'bullet' }],
//             ['link']
//         ]
//     },
//     placeholder: 'Write detailed text here...'
// });

// Set initial content from database
// quill.root.innerHTML = `<?= $row['text'] ?>`;

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