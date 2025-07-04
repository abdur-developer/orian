<style>
    :root {
      --primary-color: #4e73df;
      --secondary-color: #f8f9fc;
      --accent-color: #2e59d9;
      --text-color: #2c3e50;
    }
    .card {
      border-radius: 12px;
      transition: all 0.3s ease;
      box-shadow: 0 4px 8px rgba(0,0,0,0.08);
      cursor: pointer;
      border: none;
      overflow: hidden;
      background-color: white;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 20px rgba(0,0,0,0.15);
    }
    
    .card .card-icon {
      margin: 15px 0;
      transition: all 0.3s ease;
    }
    .card .card-icon img{
        width: 100px;
        height: 100px;
        border-radius: 50%;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        object-fit: cover;
    }
    
    .card:hover .card-icon {
      transform: scale(1.1);
    }
    
    .card-title {
      font-size: 1rem;
      font-weight: 600;
      padding: 5px 0 15px;
      color: var(--text-color);
      margin: 0;
    }
    
    .subject-container {
      position: relative;
      margin-bottom: 15px;
    }
    
    .modal-content {
      border-radius: 12px;
      border: none;
    }
    
    .modal-header {
      border-bottom: none;
      padding-bottom: 0;
    }
    
    .modal-body {
      padding: 20px;
    }
    
    .sub-item {
      background-color: white;
      padding: 12px 20px;
      border-left: 4px solid var(--primary-color);
      margin: 8px 0;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      font-weight: 500;
    }
    
    .sub-item:hover {
      transform: translateX(5px);
      background-color: var(--secondary-color);
    }
    
    .sub-item-icon {
      margin-right: 10px;
      color: var(--primary-color);
    }
    
    @media (max-width: 768px) {
      .card-title {
        font-size: 0.9rem;
      }
      
      .sub-item {
        padding: 10px 15px;
        font-size: 0.9rem;
      }
    }
</style>
<div class="container">
  <div class="row g-4">
    <?php
        $sql = "SELECT id, name, icon FROM job_apply WHERE is_initial = 1";
        $apply = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($apply)){ ?>
            <div class="col-6 col-md-4 col-lg-3 subject-container">
                <div class="card text-center p-3" data-bs-toggle="modal" data-bs-target="#modal_<?=$row['id']?>">
                    <div class="card-icon">
                        <img src="../img/apply/<?=$row['icon']?>" alt="<?=$row['name']?>" class="img-fluid">
                    </div>
                    <div class="card-title"><?=$row['name']?></div>
                </div>
            </div>
    <?php } ?>

  </div>
</div>
<?php
    $sql = "SELECT * FROM job_apply WHERE is_initial = 1";
    $apply = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($apply)){ ?>
        <div class="modal fade" id="modal_<?=$row['id']?>" tabindex="-1" aria-labelledby="modal_<?=$row['id']?>_Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal_<?=$row['id']?>_Label"><?=$row['name']?></h5>
                        <button class="btn btn-success ms-3 add-new" data-bs-toggle="modal" data-bs-target="#addItemModel">
                            <i class="fas fa-plus me-1"></i> Add more
                        </button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $sql_sub = "SELECT id, parent_id, name FROM job_apply WHERE parent_id = ".$row['id'];
                        $sub_apply = mysqli_query($conn, $sql_sub);
                        while($sub_row = mysqli_fetch_assoc($sub_apply)){ ?>
                            <div class="sub-item" onclick="location.href='?view_apply=<?=encryptSt($sub_row['id'])?>'">
                                <span class="sub-item-icon"><i class="fas fa-book"></i></span><?=$sub_row['name']?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>
<!-- Add New Modal -->
<div class="modal fade" id="addItemModel" tabindex="-1" aria-labelledby="addItemModelLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addItemModelLabel"><i class="fas fa-user-plus me-2"></i>Add New</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="mb-3">
                        <label for="userName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="userName" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="userEmail" required>
                    </div>
                    <div class="mb-3">
                        <label for="userRole" class="form-label">Role</label>
                        <select class="form-select" id="userRole" required>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                            <option value="editor">Editor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="userStatus" id="statusActive" value="1" checked>
                            <label class="form-check-label" for="statusActive">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="userStatus" id="statusInactive" value="0">
                            <label class="form-check-label" for="statusInactive">
                                Inactive
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>