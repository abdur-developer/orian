<?php

// Initialize variables
$id = isset($_GET['id']) ? decryptSt($_GET['id']) : null;
$course_id = isset($_GET['course_id']) ? $_GET['course_id'] : null;

if ($id != null) {
    $stmt = $conn->prepare("SELECT * FROM course_module WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
} else {
    $row = ['id' => null, 'title' => null];
}
?>

<!-- HTML -->
<div class="container my-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0"><i class="fas fa-video me-2"></i>Edit Video Details</h4>
                <a href="javascript:history.back()" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <form action="action/update_module.php" method="POST" class="needs-validation" novalidate id="videoForm">
                <div class="col-md-6">
                    <input type="hidden" name="course" value="<?= htmlspecialchars($course_id) ?>">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                    <!-- Title -->
                    <div class="form-floating mb-4">
                        <input type="text" name="title" class="form-control" id="title" 
                                value="<?= htmlspecialchars($row['title']) ?>" required>
                        <label for="title"><i class="fas fa-heading me-1 text-muted"></i>Title</label>
                        <div class="invalid-feedback">Please provide a title</div>
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

<script>
    // Bootstrap validation
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>