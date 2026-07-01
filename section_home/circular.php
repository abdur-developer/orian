<style>
    :root {
        --primary-color: #2563eb;
        --secondary-color: #1e40af;
        --accent-color: #3b82f6;
        --text-dark: #1f2937;
        --text-light: #6b7280;
        --bg-light: #f9fafb;
        --success-color: #10b981;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: var(--bg-light);
        color: var(--text-dark);
    }

    .job-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        border: none;
    }

    .job-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .card-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--success-color);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .card-img-container {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        padding: 20px;
    }

    .job-card img {
        width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .job-card:hover img {
        transform: scale(1.1);
    }

    .card-body {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .org-name {
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: var(--text-dark);
    }

    .job-title {
        color: var(--primary-color);
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 1rem;
    }

    .job-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2px;
    }

    .meta-item {
        display: flex;
        align-items: center;
        color: var(--text-light);
        font-size: 0.85rem;
    }

    .meta-item i {
        margin-right: 5px;
        color: var(--accent-color);
    }

    .openings {
        background-color: #f0fdf4;
        color: var(--success-color);
        padding: 2px 5px;
        border-radius: 8px;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 5px;
        font-size: 0.9rem;
    }

    .deadline {
        color: #ef4444;
        font-weight: 500;
        font-size: 0.9rem;
        margin-bottom: 2px;
    }

    .btn-view {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(37, 99, 235, 0.3);
        color: white;
    }

    .btn-view i {
        margin-left: 8px;
        transition: transform 0.3s ease;
    }

    .btn-view:hover i {
        transform: translateX(3px);
    }


    @media screen and (max-width: 768px) {
        .job-card {
            margin-bottom: 5px;
        }

        .org-name {
            font-weight: 700;
            font-size: 0.8rem;
            margin-bottom: 2px;
            color: var(--text-dark);
        }

        .job-title {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 15px;
            font-size: 0.7rem;
        }

        .job-meta {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            color: var(--text-light);
            font-size: 0.7rem;
        }

        .meta-item i {
            margin-right: 5px;
            color: var(--accent-color);
        }

        .openings {
            background-color: #f0fdf4;
            color: var(--success-color);
            padding: 2px 5px;
            border-radius: 8px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 5px;
            font-size: 0.7rem;
        }

        .deadline {
            color: #ef4444;
            font-weight: 500;
            font-size: 0.7rem;
            margin-bottom: 2px;
        }
        .btn-view {
            font-weight: 500;
            font-size: 0.8rem;
            padding: 5px 15px;
        }
        .card-body{
            padding: 5px;
        }
    }
</style>
<div class="container py-5">
    <!-- Job Cards -->
    <div class="row g-4">
        <?php 
            $sql = "SELECT id, img, title, sort_text, organization, dateline, vacancy FROM circulars";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){ ?>
            <!-- Card 1 -->
            <div class="col-lg-4 col-6">
                <div class="job-card">
                    <!-- <div class="card-badge">New</div> -->
                    <div class="card-img-container">
                        <img src="admin/upload/<?=$row['img']?>"
                            alt="RRI Logo">
                    </div>
                    <div class="card-body">
                        <h5 class="org-name"><?=$row['title']?></h5>
                        <p class="job-title"><?=$row['sort_text']?></p>
                        <div class="job-meta">
                            <!-- <span class="meta-item"><i class="fas fa-briefcase"></i> Full-time</span> -->
                            <span class="meta-item"><i class="fas fa-map-marker-alt"></i> <?=$row['organization']?></span>
                        </div>
                        <div class="openings"><?= $row['vacancy'] ?> Open Positions</div>
                        <p class="deadline"><i class="fas fa-calendar-times"></i> Deadline: <?=$row['dateline']?></p>
                        <button class="btn btn-view" onclick="location.href='?circular-details=<?=encryptSt($row['id'])?>'">
                            View Details <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

</div>