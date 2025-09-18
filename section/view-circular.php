<?php
$get_id = $_GET['circular-details'] ?? '';
$circular_id = decryptSt($get_id);
$sql = "UPDATE circulars SET view = view + 1 WHERE id = '$circular_id'";
mysqli_query($conn, $sql);
$sql = "SELECT * FROM circulars WHERE id = '$circular_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    echo "<script>window.location.href = 'index.php?error=not_found';</script>";
    exit;
}

$circular = mysqli_fetch_assoc($result);
?>
<style>
    :root {
        --primary-color: #2563eb;
        --secondary-color: #1e40af;
        --accent-color: #dc2626;
        --text-dark: #1f2937;
        --text-medium: #4b5563;
        --text-light: #6b7280;
        --bg-light: #f9fafb;
    }
    
    body {
        font-family: 'Hind Siliguri', sans-serif;
        background-color: var(--bg-light);
        color: var(--text-dark);
        line-height: 1.6;
    }
    
    
    /* Main Layout */
    .main-container {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        margin-top: 6rem;
    }
    
    .main-content {
        flex: 1;
        min-width: 0;
    }
    
    .sidebar {
        width: 350px;
    }
    
    /* Job Post Styles */
    .job-post {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        margin-bottom: 2rem;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .job-post:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    
    .job-header {
        padding: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .job-title {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
        color: var(--text-dark);
    }
    
    .job-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.2rem;
        color: var(--text-medium);
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }
    
    .job-meta-item {
        display: flex;
        align-items: center;
    }
    
    .job-meta-item i {
        margin-right: 6px;
        color: var(--primary-color);
        font-size: 0.9rem;
    }
    
    .job-organization {
        font-weight: 600;
        color: var(--primary-color);
    }
    
    .job-thumbnail {
        width: 100%;
        height: 350px;
        object-fit: cover;
    }
    
    .job-content {
        padding: 1.8rem;
    }
    
    .job-content h3 {
        font-size: 1.4rem;
        margin: 1.8rem 0 1rem;
        color: var(--secondary-color);
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 0.6rem;
    }
    
    .job-content p {
        line-height: 1.8;
        margin-bottom: 1.2rem;
        text-align: justify;
    }
    
    .job-content ul {
        margin-bottom: 1.8rem;
        padding-left: 1.8rem;
    }
    
    .job-content li {
        margin-bottom: 0.8rem;
    }
    
    .apply-btn {
        background: var(--primary-color);
        color: white;
        padding: 0.8rem 1.8rem;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        display: inline-block;
        margin-top: 1.2rem;
        text-decoration: none;
    }
    
    .apply-btn:hover {
        background: var(--secondary-color);
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
    }
    
    /* Sidebar Styles */
    .sidebar-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .sidebar-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 0.8rem;
        border-bottom: 2px solid #e5e7eb;
        color: var(--text-dark);
    }
    
    .suggested-job {
        display: flex;
        gap: 1.2rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
    }
    
    .suggested-job:hover {
        transform: translateX(5px);
    }
    
    .suggested-job:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    
    .suggested-job-img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
    }
    
    .suggested-job-content {
        flex: 1;
    }
    
    .suggested-job-title {
        font-weight: 600;
        margin-bottom: 0.4rem;
        color: var(--text-dark);
        font-size: 1.05rem;
    }
    
    .suggested-job-org {
        font-size: 0.9rem;
        color: var(--text-medium);
        margin-bottom: 0.6rem;
    }
    
    .suggested-job-deadline {
        font-size: 12px;
        color: var(--accent-color);
    }
    
    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .main-container {
            flex-direction: column;
        }
        
        .sidebar {
            width: 100%;
        }
        
        .job-thumbnail {
            height: 300px;
        }
    }
    
    @media (max-width: 768px) {
        .job-thumbnail {
            height: 250px;
        }
        
        .job-title {
            font-size: 1.4rem;
        }
        
        .blog-title {
            font-size: 1.8rem;
        }
        
        .suggested-job-img {
            width: 80px;
            height: 80px;
        }
    }
    
    @media (max-width: 576px) {
        .job-thumbnail {
            height: 200px;
        }
        
        .job-title {
            font-size: 1.3rem;
        }
        
        .job-content {
            padding: 1.2rem;
        }
        
        .job-meta {
            gap: 0.8rem;
            font-size: 0.85rem;
        }
        
        .suggested-job {
            flex-direction: column;
            gap: 0.8rem;
        }
        
        .suggested-job-img {
            width: 100%;
            height: 120px;
        }
    }
</style>

<!-- Main Content -->
<div class="container main-container">
    <!-- Main Job Circular Content -->
    <main class="main-content">
        <article class="job-post">
            <div class="job-header">
                <h1 class="job-title"><?=$circular['title']?></h1>
                <div class="job-meta">
                    <span class="job-meta-item"><i class="fas fa-building"></i> <span class="job-organization"><?=$circular['organization']?></span></span>
                    <span class="job-meta-item"><i class="fas fa-map-marker-alt"></i> <?=$circular['location']?></span>
                    <span class="job-meta-item"><i class="fas fa-calendar-alt"></i> আবেদনের শেষ তারিখ: <?=$circular['dateline']?></span>
                    <span class="job-meta-item"><i class="fas fa-users"></i> শূন্য পদ: <?=$circular['vacancy']?></span>
                </div>
            </div>
            <img src="admin/upload/<?=$circular['img']?>" class="job-thumbnail">
            <div class="job-content">
                <?=$circular['description']?>
                <a href="<?=$circular['g_form_link']?>" target="_blank" class="apply-btn">আবেদন করুন <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </article>
    </main>
    
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-card">
            <h3 class="sidebar-title">সাম্প্রতিক চাকরি</h3>
            <?php
            $sql = "SELECT * FROM circulars ORDER BY created_at DESC LIMIT 3";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <a href="?circular-details=<?=encryptSt($row['id'])?>" class="suggested-job">
                    <img src="admin/upload/<?=$row['img']?>" alt="<?=$row['title']?>" class="suggested-job-img">
                    <div class="suggested-job-content">
                        <h4 class="suggested-job-title"><?=$row['title']?></h4>
                        <p class="suggested-job-org"><?=$row['organization']?></p>
                        <p class="suggested-job-deadline">আবেদনের শেষ তারিখ: <?=$row['dateline']?></p>
                    </div>
                </a>
            <?php
            }
            ?>
        </div>
        
        <div class="sidebar-card">
            <h3 class="sidebar-title">জনপ্রিয় চাকরি</h3>
            <?php
             $sql = "SELECT * FROM circulars ORDER BY view DESC LIMIT 3";
             $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <a href="?circular-details=<?=encryptSt($row['id'])?>" class="suggested-job">
                        <img src="admin/upload/<?=$row['img']?>" alt="<?=$row['title']?>" class="suggested-job-img">
                        <div class="suggested-job-content">
                            <h4 class="suggested-job-title"><?=$row['title']?></h4>
                            <p class="suggested-job-org"><?=$row['organization']?></p>
                            <p class="suggested-job-deadline">আবেদনের শেষ তারিখ: <?=$row['dateline']?></p>
                        </div>
                    </a>
            <?php
                }
            ?>
        </div>
    </aside>
</div>