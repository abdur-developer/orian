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
                        <img src="img/apply/<?=$row['icon']?>" alt="<?=$row['name']?>" class="img-fluid">
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