<?php
    $id = decryptSt($_GET['view_apply']);
    $sql = "SELECT details , google_form FROM job_apply WHERE id = $id";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
?>
<style>
    .content-box {
        background-color: #fff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .btn-custom {
        font-weight: bold;
        padding: 12px 25px;
        font-size: 16px;
    }
</style>
<div class="content-box">
    <div class="from-server"><?=$row['details']?></div>

    <div class="text-center mt-4">
      <a href="<?=$row['google_form']?>" target="_blank" class="btn btn-primary btn-custom">
        আবেদন করুন <i class="bi bi-arrow-right"></i>
      </a>
    </div>
</div>