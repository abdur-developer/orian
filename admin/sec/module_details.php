<?php
    $module_id = isset($_GET['id']) ? decryptSt($_GET['id']) : null;
    // Fetch data
    $sql = "SELECT * FROM module_details WHERE module_id = '$module_id' ORDER BY id ASC";
    $result = $conn->query($sql);
?>
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="fas fa-users-cog me-2"></i>Module Details</h3>
                <div class="d-flex align-items-center">
                    <button class="btn btn-success ms-3 add-new" onclick="location.href='?e=module_details&module_id=<?=$module_id?>'">
                        <i class="fas fa-plus me-1"></i> Add new
                    </button>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <?php if ($result->num_rows > 0): ?>
                <div class="table-responsive table-container mb-4">
                    <table class="table table-hover user-table">
                        <thead>
                            <tr>
                                <th width="40%">Title</th>
                                <th width="15%">Time</th>
                                <th width="10%">Is Free</th>
                                <th width="25%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row["title"]) ?></td>
                                <td><?= htmlspecialchars($row["time"]) ?></td>
                                <td>
                                    <button class="btn btn-sm <?= $row['is_free'] == 0 ? 'btn-success' : 'btn-secondary' ?>">
                                        <?= $row['is_free'] == 1 ? 'Free' : 'Paid' ?>
                                    </button>
                                </td>
                                <td class="text-center action-buttons">
                                    <button class="btn btn-sm btn-view me-1" title="View" onclick="openVideo('<?= htmlspecialchars($row['video']) ?>')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-edit me-1" title="Edit" onclick="location.href='?e=module_details&id=<?= encryptSt($row['id']) ?>&module_id=<?=$module_id?>'">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-delete" title="Delete" data-bs-toggle="modal" data-id="<?= htmlspecialchars($row["id"]) ?>"  data-bs-target="#deleteItemModel">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-user-slash fa-4x text-muted"></i>
                    </div>
                    <h4 class="text-muted mb-3">
                        <?php if (!empty($search)): ?>
                            No course_module found matching your search criteria
                        <?php else: ?>
                            No course_module found in the database
                        <?php endif; ?>
                    </h4>
                    <?php if (!empty($search)): ?>
                        <a href="?" class="btn btn-primary mt-2">
                            <i class="fas fa-undo me-1"></i> Reset Search
                        </a>
                    <?php else: ?>
                        <button class="btn btn-primary mt-2 add-new" onclick="location.href='?e=module_details&module_id=<?=$module_id?>'">
                            <i class="fas fa-plus me-1"></i> Add New
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<style>
    /* ডায়ালগ স্টাইল */
    .video-dialog {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 1000;
        justify-content: center;
        align-items: center;
    }
    
    .video-container {
        width: 90%;
        max-width: 800px;
        position: relative;
    }
    
    .video-container video {
        width: 100%;
        border-radius: 5px;
    }
    
    .close-btn {
        position: absolute;
        top: -40px;
        right: 0;
        color: white;
        font-size: 30px;
        cursor: pointer;
        background: none;
        border: none;
    }
</style>
<!-- ভিডিও ডায়ালগ -->
<div class="video-dialog" id="videoDialog">
    <div class="video-container">
        <button class="close-btn" onclick="closeVideo()">&times;</button>
        <video controls id="myVideo">
            <!-- আপনার ভিডিও ফাইল লিংক দিন -->
            <source src="" id="vid-source" type="video/mp4">
            আপনার ব্রাউজার ভিডিও সাপোর্ট করে না।
        </video>
    </div>
</div>
<!-- Delete Modal -->
<div class="modal fade" id="deleteItemModel" tabindex="-1" aria-labelledby="deleteItemModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="deleteItemModelLabel"><i class="fas fa-trash-alt me-2"></i>Delete Confirmation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this chat suggestion? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" data-id="" id="btnConfirmDelete">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Custom JS -->
<script>
    // Tooltip initialization
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function() {
                const itemId = this.getAttribute('data-id');
                document.getElementById('btnConfirmDelete').setAttribute('data-id', itemId);
            });
        });

        document.getElementById('btnConfirmDelete').addEventListener('click', function() {
            const idToDelete = this.getAttribute('data-id');
            fetch('api/delete_with_vid.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: idToDelete })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    toast(data.message, 'error');
                }
            })
            .catch(error => {
                toast('An error occurred while deleting.', 'error');
            });
        });
    });
    // ভিডিও ওপেন ফাংশন
    function openVideo(vidLink) {
        const dialog = document.getElementById('videoDialog');
        const vid_source = document.getElementById('vid-source');
        const video = document.getElementById('myVideo');

        vid_source.src = "../secure_storage/videos/" + vidLink;
        video.load();
        dialog.style.display = 'flex';
        video.play();
    }
    
    // ভিডিও ক্লোজ ফাংশন
    function closeVideo() {
        const dialog = document.getElementById('videoDialog');
        const video = document.getElementById('myVideo');
        
        dialog.style.display = 'none';
        video.pause();
        video.currentTime = 0;
    }
    
    // ESC কী প্রেস করলে ভিডিও বন্ধ হবে
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeVideo();
        }
    });
</script>