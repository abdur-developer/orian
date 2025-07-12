<?php
    $id = isset($_GET['id']) ? decryptSt($_GET['id']) : null;
    if($id != null){
        $sql = "SELECT * FROM course WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }else{
        $row = [
            'id' => null,
            'title' => null,
            'overview' => null,
            'ki_thakbe' => null,
            'provider' => null,
            'img' => null,
            'description' => null, //this is sort description
            'badge' => null,
            'users' => null,
            'old_price' => null,
            'feature_video_id' => null,
            'instructor' => null,
            'rating' => null,
            'price' => null
        ];
    }
?>

<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Course Details</h4>
                <a href="javascript:history.back()" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- <php if ($result->num_rows > 0): ?> -->
            <form action="action/update_course.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                <input type="hidden" name="overview" id="quill-html">
                
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
                        
                        <!-- Provider -->
                        <div class="form-floating mb-4">
                            <input type="text" name="provider" class="form-control" id="provider" 
                                   value="<?= htmlspecialchars($row['provider']) ?>" required>
                            <label for="provider"><i class="fas fa-building me-1 text-muted"></i>Provider</label>
                            <div class="invalid-feedback">Please provide a provider name</div>
                        </div>
                        
                        <!-- Instructor -->
                        <div class="form-floating mb-4">
                            <input type="text" name="instructor" class="form-control" id="instructor" 
                                   value="<?= htmlspecialchars($row['instructor']) ?>">
                            <label for="instructor"><i class="fas fa-user-tie me-1 text-muted"></i>Instructor</label>
                        </div>
                        
                        <!-- Short Description -->
                        <div class="form-floating mb-4">
                            <input type="text" name="description" class="form-control" id="description" 
                                   value="<?= htmlspecialchars($row['description']) ?>">
                            <label for="description"><i class="fas fa-info-circle me-1 text-muted"></i>Short Description</label>
                        </div>
                        <!-- Price -->
                        <div class="form-floating mb-4">
                            <input type="number" name="price" class="form-control" id="price" 
                                   value="<?= htmlspecialchars($row['price']) ?>">
                            <label for="price"><i class="fas fa-tag me-1 text-muted"></i>Price</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="number" name="old_price" class="form-control" id="old_price" 
                                   value="<?= htmlspecialchars($row['old_price']) ?>">
                            <label for="old_price"><i class="fas fa-tag me-1 text-muted"></i>Old Price</label>
                        </div>

                        <!-- What You Will Get in This Course (ki_thakbe) -->
                        <div class="mb-4">
                            <label class="form-label">
                                <i class="fas fa-check-circle me-1 text-muted"></i>What You Will Get in This Course
                            </label>
                            <div id="ki-thakbe-container">
                                <?php
                                $ki_thakbe_items = json_decode($row['ki_thakbe'] ?? '[]', true);
                                if (!empty($ki_thakbe_items)) {
                                    foreach ($ki_thakbe_items as $item) {
                                        echo '<div class="input-group mb-2">
                                            <input type="text" name="ki_thakbe[]" class="form-control" value="'.htmlspecialchars($item).'">
                                            <button type="button" class="btn btn-danger remove-item"><i class="fas fa-times"></i></button>
                                        </div>';
                                    }
                                } else {
                                    echo '<div class="input-group mb-2">
                                        <input type="text" name="ki_thakbe[]" class="form-control">
                                        <button type="button" class="btn btn-danger remove-item"><i class="fas fa-times"></i></button>
                                    </div>';
                                }
                                ?>
                            </div>
                            <button type="button" id="add-ki-thakbe" class="btn btn-sm btn-success mt-2">
                                <i class="fas fa-plus me-1"></i> Add Another Item
                            </button>
                        </div>
                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-image me-1 text-muted"></i>Course Image</label>
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
                            <input type="file" name="img" class="form-control" accept="image/*">
                            <small class="text-muted">Max size: 2MB (JPEG, PNG)</small>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Status Toggle Switch -->
                        <div class="d-flex mb-4">
                            <label class="form-label d-block" style="width: 100px;">
                                <i class="fas fa-power-off me-1 text-muted"></i>Status
                            </label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="status" value="0"> <!-- Default value when unchecked -->
                                <input class="form-check-input" type="checkbox" role="switch" id="statusToggle" 
                                    name="status" value="1" <?= ($row['status'] ?? 0) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="statusToggle">
                                    <?= ($row['status'] ?? 0) ? 'Active' : 'Inactive' ?>
                                </label>
                            </div>
                        </div>
                        <!-- Overview with Quill Editor -->
                        <div class="mb-4">
                            <label for="quill-editor" class="form-label">
                                <i class="fas fa-align-left me-1 text-muted"></i>Overview
                            </label>
                            <div id="quill-editor" style="height: 300px;">
                                <?= $row['overview'] ?>
                            </div>
                            <small class="text-muted">Write detailed overview with formatting options</small>
                        </div>
                        <!-- rating -->
                        <div class="form-floating mb-4">
                            <input type="number" name="rating" class="form-control" id="rating" 
                                   value="<?= htmlspecialchars($row['rating']) ?>">
                            <label for="rating"><i class="fas fa-tag me-1 text-muted"></i>Rating(1.0-5.0)</label>
                        </div>
                        <!-- users -->
                        <div class="form-floating mb-4">
                            <input type="number" name="users" class="form-control" id="users" 
                                   value="<?= htmlspecialchars($row['users']) ?>">
                            <label for="users"><i class="fas fa-tag me-1 text-muted"></i>Enrolled Users</label>
                        </div>
                        <!-- badge -->
                        <div class="form-floating mb-4">
                            <input type="text" name="badge" class="form-control" id="badge" 
                                   value="<?= htmlspecialchars($row['badge']) ?>">
                            <label for="badge"><i class="fas fa-tag me-1 text-muted"></i>Badge</label>
                        </div>
                        <!-- YouTube Video ID -->
                        <?php if (!empty($row['feature_video_id'])): ?>
                            <div class="mb-3 text-center">
                                <iframe src="https://www.youtube.com/embed/<?= htmlspecialchars($row['feature_video_id']) ?>" frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen="" style="max-height: 200px;"></iframe>
                            </div>
                        <?php endif; ?>
                        <div class="form-floating mb-4">
                            <input type="text" name="feature_video_id" class="form-control" id="feature_video_id" 
                                   value="<?= htmlspecialchars($row['feature_video_id']) ?>">
                            <label for="feature_video_id"><i class="fab fa-youtube me-1 text-muted"></i>YouTube Video ID</label>
                        </div>
                        
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-undo me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary px-4" id="submit-btn">
                        <i class="fas fa-save me-1"></i> Update Course
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    document.getElementById('statusToggle').addEventListener('change', function() {
        const label = this.nextElementSibling;
        label.textContent = this.checked ? 'Active' : 'Inactive';
    });
    // Initialize Quill Editor
    const quill = new Quill('#quill-editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                [{ 'align': [] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link']
            ]
        },
        placeholder: 'Write detailed overview here...'
    });

    // Set initial content from database
    quill.root.innerHTML = `<?= $row['overview'] ?>`;

    // Form submission handler
    document.querySelector('form').addEventListener('submit', function(e) {
        // Get HTML content from Quill and put it in hidden input
        const quillHtml = document.getElementById('quill-html');
        quillHtml.value = quill.root.innerHTML;
        
        // Basic form validation
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        this.classList.add('was-validated');
    });
    //ki thakbe
    document.getElementById('add-ki-thakbe').addEventListener('click', function() {
        const container = document.getElementById('ki-thakbe-container');
        const newItem = document.createElement('div');
        newItem.className = 'input-group mb-2';
        newItem.innerHTML = `
            <input type="text" name="ki_thakbe[]" class="form-control">
            <button type="button" class="btn btn-danger remove-item"><i class="fas fa-times"></i></button>
        `;
        container.appendChild(newItem);
    });

    // Remove item
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item') || e.target.closest('.remove-item')) {
            const itemToRemove = e.target.closest('.input-group');
            if (itemToRemove) {
                itemToRemove.remove();
            }
        }
    });

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