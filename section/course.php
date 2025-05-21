<style>
    /* Courses */
    
    .course-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        background: white;
    }
    
    .course-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
    }
    
    .course-img-container {
        height: 200px;
        overflow: hidden;
        position: relative;
    }
    
    .course-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .course-card:hover .course-img {
        transform: scale(1.05);
    }
    
    .course-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--accent-color);
        color: white;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        height: calc(100% - 200px);
    }
    
    .course-provider {
        color: var(--primary-color);
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 5px;
    }
    
    .course-title {
        font-weight: 700;
        font-size: 20px;
        line-height: 1.4;
        margin-bottom: 12px;
        color: var(--text-dark);
    }
    
    .course-desc {
        color: var(--text-medium);
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 15px;
        flex-grow: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .course-meta {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        font-size: 13px;
    }
    
    .course-meta-item {
        display: flex;
        align-items: center;
        color: var(--text-light);
    }
    
    .course-meta-item i {
        margin-right: 5px;
        color: var(--primary-color);
    }
    
    .course-price {
        font-weight: 700;
        font-size: 18px;
        color: var(--primary-color);
        margin-bottom: 15px;
    }
    
    .course-price del {
        font-size: 14px;
        color: var(--text-light);
        margin-left: 8px;
    }
    
    .btn-enroll {
        background: var(--primary-color);
        color: white;
        font-weight: 600;
        border-radius: 6px;
        padding: 8px;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-enroll:hover {
        background: #1d4a9e;
        transform: translateY(-2px);
    }
    
    .btn-details {
        background: white;
        color: var(--primary-color);
        font-weight: 600;
        border-radius: 6px;
        padding: 8px;
        transition: all 0.3s ease;
        border: 1px solid var(--primary-color);
    }
    
    .btn-details:hover {
        background: var(--secondary-color);
        transform: translateY(-2px);
    }
    
    @media (max-width: 768px) {
        .course-title {
            font-size: 18px;
        }
        
        .course-desc {
            -webkit-line-clamp: 2;
        }
    }
</style>
<!-- Courses Section -->
<section class="section bg-light">
    <!-- Main Content -->
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">আমাদের জনপ্রিয় কোর্সসমূহ</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">সেরা প্রশিক্ষকদের সাথে প্রস্তুতি নিন আপনার পছন্দের চাকরির জন্য</p>
        <!-- ================================================== -->      
        <div class="row g-4">
            <?php 
                $sql ="SELECT id, price, users, title, description, badge, provider FROM course";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){ ?>
            <div class="col-lg-4 col-md-6">
                <div class="course-card">
                    <div class="course-img-container">
                        <img src="https://instantjob.sgp1.cdn.digitaloceanspaces.com/course_image/eb330f06312b4065a7780b7dffecd3e2-website(2).png" class="course-img" alt="Army Commissioned Officer Course">
                        <?php if($row['badge'] != null) echo "<span class='course-badge'>{$row['badge']}</span>"; ?>
                    </div>
                    <div class="card-body">
                        <span class="course-provider"><?=$row['provider']?></span>
                        <h3 class="course-title"><?=$row['title']?></h3>
                        <p class="course-desc"><?=$row['description']?></p>
                        
                        <div class="course-meta">
                            <span class="course-meta-item"><i class="fas fa-users"></i> <?=$row['users']?> Students</span>
                            <!-- <span class="course-meta-item"><i class="fas fa-certificate"></i> Certificate</span> -->
                            <div class="course-price">
                                মূল্য : <?=$row['price']?>৳
                            </div>
                        </div>
                        
                        
                        <div class="d-grid gap-2 d-md-flex">
                            <button onclick="detailsCourse('<?=encryptSt($row['id'])?>')" class="btn btn-details flex-grow-1"><i class="fas fa-info-circle me-2"></i>বিস্তারিত দেখুন</button>
                            <button class="btn btn-enroll flex-grow-1"><i class="fas fa-arrow-right-to-bracket me-2"></i>এনরোল করুন</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <script>
            function detailsCourse(id) {
                window.location.href = "course-details.php?course=" + id;
            }
        </script>
        <!-- ================================================== -->
    </div>
</section>