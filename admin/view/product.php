<?php
    $id = isset($_GET['id']) ? decryptSt($_GET['id']) : null;
    if($id != null){
        $sql = "SELECT * FROM product WHERE id = '$id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    }else{
        $cate_id = $_GET['cate_id'];
        $row = [
            'id' => null,
            'name' => null,
            'type' => decryptSt($cate_id),
            'price' => null,
            'old_price' => null,
            'rating_count' => null,
            'img' => null,
            'description' => null,
            'review' => null,
            'colors' => null,
            'is_feature' => null,
            'd_discount' => 0,
            'sizes' => null,
            'status' => null
        ];
    }
?>

<!-- Quill CSS -->
<!-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> -->

<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Product Details</h4>
                <a href="javascript:history.back()" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <!-- <php if ($result->num_rows > 0): ?> -->
            <form action="action/update_product.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                <!-- <input type="hidden" name="description" id="quill-html"> -->
                
                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Title -->
                        <div class="form-floating mb-4">
                            <input type="text" name="name" class="form-control" id="name" 
                                   value="<?= htmlspecialchars($row['name']) ?>" required>
                            <label for="name"><i class="fas fa-heading me-1 text-muted"></i>Title</label>
                            <div class="invalid-feedback">Please provide a name</div>
                        </div>
                        
                        <!-- Category -->
                        <div class="form-floating mb-4">
                            <select name="type" id="type" class="form-control">
                                <option disabled>Select Category</option>
                                <?php
                                    $sql = "SELECT * FROM category_product";
                                    $categories = mysqli_query($conn, $sql);
                                    while($category = mysqli_fetch_assoc($categories)){ ?>
                                        <option value="<?= $category['id'] ?>" <?= $row['type'] == $category['id'] ? 'selected' : '' ?>>
                                            <?= $category['name'] ?>
                                        </option>
                                    <?php } ?>
                            </select>
                            <label for="type"><i class="fas fa-building me-1 text-muted"></i>Category</label>
                            <div class="invalid-feedback">Please provide an type name</div>
                        </div>
                                                
                        <!-- Price -->
                        <div class="form-floating mb-4">
                            <input type="number" name="price" class="form-control" id="price" 
                                   value="<?= htmlspecialchars($row['price']) ?>">
                            <label for="price"><i class="fas fa-info-circle me-1 text-muted"></i>Price</label>
                        </div>
                                                
                        <!--Old  Price -->
                        <div class="form-floating mb-4">
                            <input type="number" name="old_price" class="form-control" id="old_price" 
                                   value="<?= htmlspecialchars($row['old_price']) ?>">
                            <label for="old_price"><i class="fas fa-info-circle me-1 text-muted"></i>Old Price</label>
                        </div>
                                                
                        <!--rating count -->
                        <div class="form-floating mb-4">
                            <input type="number" name="rating_count" class="form-control" id="rating_count" 
                                   value="<?= htmlspecialchars($row['rating_count']) ?>">
                            <label for="rating_count"><i class="fas fa-info-circle me-1 text-muted"></i>Rating Count</label>
                        </div>
                        
                        <!-- Is Feature -->
                        <div class="form-floating mb-4">
                            <select name="is_feature" class="form-control" id="is_feature">
                                <option value="0" <?= $row['is_feature'] == 0 ? 'selected' : '' ?>>Normal</option>
                                <option value="1" <?= $row['is_feature'] == 1 ? 'selected' : '' ?>>Featured</option>
                                <option value="2" <?= $row['is_feature'] == 2 ? 'selected' : '' ?>>Special</option>
                            </select>
                            <label for="is_feature"><i class="fas fa-toggle-on me-1 text-muted"></i>Section type</label>
                        </div>
                        <!-- Description with Quill Editor -->
                        <div class="mb-4">
                            <label for="quill-editor" class="form-label">
                                <i class="fas fa-align-left me-1 text-muted"></i>Description
                            </label>
                            <div id="quill-editor" style="height: 400px;">
                                <textarea id="tiny" name="description" style="height: 300px; width: 100%;"><?= $row['description'] ?></textarea>
                            </div>
                            <small class="text-muted">Write detailed text with formatting options</small>
                        </div>
                        
                        <!-- Date -->
                        <div class="form-floating mb-4">
                            <input type="text" name="status" class="form-control" id="status" 
                                   value="<?= htmlspecialchars($row['status']) ?>">
                            <label for="status"><i class="fas fa-calendar-alt me-1 text-muted"></i>Status</label>
                        </div>
                        
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- review -->
                        <div class="form-floating mb-4">
                            <input type="text" name="review" class="form-control" id="review" 
                                   value="<?= htmlspecialchars($row['review']) ?>">
                            <label for="review"><i class="fas fa-users me-1 text-muted"></i>Review</label>
                        </div>
                        
                        <!-- colors -->
                        <div class="form-floating mb-4">
                            <input type="text" name="colors" class="form-control" id="colors" 
                                   value="<?= htmlspecialchars($row['colors']) ?>">
                            <label for="colors"><i class="fas fa-palette me-1 text-muted"></i>Colors (separate with commas)</label>
                        </div>
                        
                        <!-- sizes -->
                        <div class="form-floating mb-4">
                            <input type="text" name="sizes" class="form-control" id="sizes" 
                                   value="<?= htmlspecialchars($row['sizes']) ?>">
                            <label for="sizes"><i class="fas fa-ruler me-1 text-muted"></i>Sizes (separate with commas)</label>
                        </div>
                        
                        <!-- d_discount -->
                        <div class="form-floating mb-4">
                            <input type="number" name="d_discount" class="form-control" id="d_discount" maxlength="3"
                                   value="<?= htmlspecialchars($row['d_discount'] ?? 0) ?>">
                            <label for="d_discount"><i class="fas fa-info-circle me-1 text-muted"></i>Delivery discount</label>
                        </div>
                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-image me-1 text-muted"></i>Post Image 1</label>
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
                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-image me-1 text-muted"></i>Post Image 2</label>
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
                            <input type="file" name="img_2" class="form-control" accept="image/*">
                            <small class="text-muted">Max size: 2MB (JPEG, PNG)</small>
                        </div>
                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label class="form-label"><i class="fas fa-image me-1 text-muted"></i>Post Image 3</label>
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