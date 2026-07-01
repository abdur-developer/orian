<?php
function formatBytes($bytes, $precision = 2) {
    $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, $precision) . ' ' . $units[$pow];
}

// Initialize variables
$id = isset($_GET['id']) ? decryptSt($_GET['id']) : null;
$module_id = isset($_GET['module_id']) ? $_GET['module_id'] : null;
$maxUploadSize = 500 * 1024 * 1024; // 500MB
$allowedTypes = ['video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'];

if ($id != null) {
    $stmt = $conn->prepare("SELECT * FROM module_details WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
} else {
    $row = [
        'id' => null,
        'title' => null,
        'time' => null,
        'video' => null
    ];
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
            <form action="action/update_mod_details.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="videoForm">
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                <input type="hidden" name="MAX_FILE_SIZE" value="<?= $maxUploadSize ?>">

                <div class="row g-4">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <input type="hidden" name="module_id" value="<?=$module_id?>">
                        <!-- Title -->
                        <div class="form-floating mb-4">
                            <input type="text" name="title" class="form-control" id="title" 
                                   value="<?= htmlspecialchars($row['title']) ?>" required>
                            <label for="title"><i class="fas fa-heading me-1 text-muted"></i>Title</label>
                            <div class="invalid-feedback">Please provide a title</div>
                        </div>

                        <!-- Video Duration -->
                        <div class="form-floating mb-4">
                            <input type="text" name="time" class="form-control" id="duration" 
                                   value="<?= htmlspecialchars($row['time']) ?>">
                            <label for="duration"><i class="fas fa-clock me-1 text-muted"></i>Duration (optional)</label>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Status Toggle Switch -->
                        <div class="d-flex mb-4">
                            <label class="form-label d-block" style="width: 100px;">
                                <i class="fas fa-power-off me-1 text-muted"></i> Is free
                            </label>
                            <div class="form-check form-switch">
                                <input type="hidden" name="is_free" value="0"> <!-- Default value when unchecked -->
                                <input class="form-check-input" type="checkbox" role="switch" id="statusToggle" 
                                    name="is_free" value="1" <?= ($row['is_free'] ?? 0) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="statusToggle">
                                    <?= ($row['is_free'] ?? 0) ? 'Free' : 'Paid' ?>
                                </label>
                            </div>
                        </div>
                        <!-- Current Video Preview -->
                        <?php if (!empty($row['video'])): ?>
                            <div class="mb-4">
                                <label class="form-label"><i class="fas fa-video me-1 text-muted"></i>Current Video</label>
                                <div class="video-preview-container">
                                    <video controls class="w-100 rounded" style="max-height: 200px;">
                                        <source src="../secure_storage/videos/<?= htmlspecialchars($row['video']) ?>" type="video/mp4">
                                        <source src="../secure_storage/videos/<?= htmlspecialchars($row['video']) ?>" type="video/webm">
                                        <source src="../secure_storage/videos/<?= htmlspecialchars($row['video']) ?>" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Video Upload -->
                        <div class="mb-4">
                            <label for="video" class="form-label"><i class="fas fa-upload me-1 text-muted"></i>Upload New Video</label>
                            <input type="file" name="video" class="form-control" id="video" accept="video/*">
                            <div class="progress mt-2 d-none" id="uploadProgress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%"></div>
                            </div>
                            <div id="fileInfo" class="small mt-2"></div>
                            <small class="text-muted">Max size: <?= formatBytes($maxUploadSize) ?> (MP4, WebM, Ogg, QuickTime)</small>
                            <div class="invalid-feedback" id="videoError"></div>
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

<script>
    document.getElementById('statusToggle').addEventListener('change', function() {
        const label = this.nextElementSibling;
        label.textContent = this.checked ? 'Free' : 'Paid';
    });

    // Helper to format bytes
    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024, dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    // Video file validation
    const allowedTypes = <?= json_encode($allowedTypes) ?>;
    const maxSize = <?= $maxUploadSize ?>;

    document.getElementById('video').addEventListener('change', function () {
        const file = this.files[0];
        const fileInfo = document.getElementById('fileInfo');
        const videoError = document.getElementById('videoError');
        const submitBtn = document.getElementById('submit-btn');

        if (file) {
            fileInfo.innerHTML = `
                <strong>Selected file:</strong> ${file.name}<br>
                <strong>Size:</strong> ${formatBytes(file.size)}<br>
                <strong>Type:</strong> ${file.type}
            `;

            if (file.size > maxSize) {
                videoError.textContent = `File too large. Max size is ${formatBytes(maxSize)}.`;
                this.classList.add('is-invalid');
                submitBtn.disabled = true;
            } else if (!allowedTypes.includes(file.type)) {
                videoError.textContent = 'Invalid file type. Please upload a supported video file.';
                this.classList.add('is-invalid');
                submitBtn.disabled = true;
            } else {
                this.classList.remove('is-invalid');
                submitBtn.disabled = false;
            }
        } else {
            fileInfo.innerHTML = '';
            this.classList.remove('is-invalid');
            submitBtn.disabled = false;
        }
    });

    // AJAX Submit
    document.getElementById('videoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);
        const progressBar = document.getElementById('uploadProgress');
        const progressBarInner = progressBar.querySelector('.progress-bar');
        const submitBtn = document.getElementById('submit-btn');
        
        // Always show progress bar for consistency
        progressBar.classList.remove('d-none');
        submitBtn.disabled = true;
        
        const xhr = new XMLHttpRequest();
        xhr.open('POST', form.action, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        
        xhr.upload.onprogress = function(e) {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progressBarInner.style.width = percent + '%';
                progressBarInner.textContent = percent + '%';
                // Change color at certain percentages
                if (percent > 90) progressBarInner.classList.add('bg-success');
            }
        };
        
        xhr.onload = function() {
            progressBar.classList.add('d-none');
            submitBtn.disabled = false;
            
            try {
                const response = JSON.parse(xhr.responseText);
                if (xhr.status >= 200 && xhr.status < 300) {
                    if (response.success) {
                        toast(response.message, 'success');
                        setTimeout(() => {
                            if (typeof response.redirect === 'string' && response.redirect.length > 0) {
                                window.location.href = response.redirect;
                            } else {
                                window.history.back();
                                window.location.reload();
                            }
                        }, 1500);
                    } else {
                        toast(response.message || 'Operation failed', 'error');
                    }
                } else {
                    toast(response.message || `Server error (${xhr.status})`, 'error');
                }
            } catch (err) {
                console.error('Error parsing response:', err, xhr.responseText);
                toast('Invalid server response format', 'error');
            }
        };
        
        xhr.onerror = function() {
            progressBar.classList.add('d-none');
            submitBtn.disabled = false;
            toast('Network error - failed to connect to server', 'error');
        };
        
        xhr.send(formData);
    });

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