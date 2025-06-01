<style>
    .card-body{
        padding: 10px 20px;
    }
    /* Category Styles */
    .category-section {
        background-color: white;
        border-radius: 10px;
        padding: 15px;
        margin: 10px 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    
    .category-icon {
        width: 50px;
        height: 50px;
        background: var(--secondary-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: var(--primary-color);
        font-size: 20px;
    }
    
    .category-title {
        font-size: 14px;
        margin-top: 8px;
        text-align: center;
    }
    
    /* Course Card Styles */
    .course-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s;
        margin-bottom: 15px;
        background-color: white;
    }
    
    .course-card:hover {
        transform: translateY(-5px);
    }
    
    .course-img {
        height: 120px;
        object-fit: cover;
        width: 100%;
    }
    
    .course-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 5px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .instructor {
        font-size: 13px;
        color: var(--light-text);
    }
    
    .price {
        font-weight: 700;
        color: var(--primary-color);
    }
    
    .rating {
        font-size: 13px;
        color: #ffc107;
    }
    
    /* Responsive Adjustments */
    @media (min-width: 768px) {
        .course-img {
            height: 150px;
        }
        
        .category-icon {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }
    }
    /* Modern Carousel */
    .modern-carousel {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        margin-bottom: 2.5rem;
    }
    
    .modern-carousel .carousel-inner {
        border-radius: 16px;
        overflow: hidden;
    }
    
    .modern-carousel img {
        height: 300px;
        object-fit: cover;
        object-position: center;
        filter: brightness(0.95);
        transition: transform 0.5s ease;
    }
    
    .modern-carousel .carousel-item:hover img {
        transform: scale(1.03);
    }
    
    .modern-carousel .carousel-indicators {
        bottom: 20px;
    }
    
    .modern-carousel .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255,255,255,0.5);
        border: 2px solid transparent;
        transition: all 0.3s ease;
        margin: 0 6px;
    }
    
    .modern-carousel .carousel-indicators .active {
        background-color: #fff;
        transform: scale(1.2);
        border-color: #2563eb;
    }
</style>
<!-- Modern Carousel -->
<div id="modernCarousel" class="carousel slide modern-carousel" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" class="d-block w-100" alt="Learning Community">
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="d-block w-100" alt="Online Education">
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="d-block w-100" alt="Graduation Celebration">
        </div>
    </div>
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#modernCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#modernCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#modernCarousel" data-bs-slide-to="2"></button>
    </div>
</div>
<!-- Category Section -->
<div class="category-section">
    <h2 class="h5 fw-bold mb-3">ক্যাটাগরি</h2>
    <div class="row g-3">
        <!-- Category 1 -->
        <div class="col-4 col-md-2">
            <div class="category-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <p class="category-title mb-0">কোর্স</p>
        </div>
        <!-- Category 2 -->
        <div class="col-4 col-md-2">
            <div class="category-icon">
                <i class="fas fa-book"></i>
            </div>
            <p class="category-title mb-0">বই</p>
        </div>
        <!-- Category 3 -->
        <div class="col-4 col-md-2">
            <div class="category-icon">
                <i class="fas fa-tshirt"></i>
            </div>
            <p class="category-title mb-0">পোশাক</p>
        </div>
        <!-- Category 4 -->
        <div class="col-4 col-md-2">
            <div class="category-icon">
                <i class="fas fa-glasses"></i>
            </div>
            <p class="category-title mb-0">অ্যাকসেসরিজ</p>
        </div>
        <!-- Category 5 -->
        <div class="col-4 col-md-2">
            <div class="category-icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <p class="category-title mb-0">মেন্টরশিপ</p>
        </div>
        <!-- Category 6 -->
        <div class="col-4 col-md-2">
            <div class="category-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            <p class="category-title mb-0">সার্কুলার</p>
        </div>
    </div>
</div>

<!-- Popular Courses -->
<div class="category-section">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 fw-bold">জনপ্রিয় কোর্স</h2>
        <a href="#" class="text-primary text-decoration-none small">সব দেখুন</a>
    </div>
    <div class="row g-3">
        <!-- ============ -->
        <?php
            $sql = "SELECT * FROM course ORDER BY `rating` DESC LIMIT 6";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-md-6 col-lg-4" onclick="location.href='index.php?course-details=<?= encryptSt($row['id']) ?>'">
                        <div class="course-card">
                            <img src="<?php echo $row['img']; ?>" class="course-img" alt="Course">
                            <div class="card-body">
                                <h5 class="course-title"><?php echo $row['title']; ?></h5>
                                <p class="instructor mb-2"><?php echo $row['instructor']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price">৳<?php echo $row['price']; ?></span>
                                    <span class="rating"><i class="fas fa-star"></i> <?php echo $row['rating']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php }} ?>
        <!-- =========== -->
    </div>
</div>

<!-- Order Now Section -->
<div class="category-section">
    <h2 class="h5 fw-bold mb-3">অর্ডার করুন</h2>
    <div class="row g-3">
        <?php
        $sql = "SELECT * FROM product ORDER BY `rating_count` DESC LIMIT 8";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <div class="col-6 col-md-4 col-lg-3" onclick="location.href='index.php?product-details=<?= encryptSt($row['id']) ?>'">
                    <div class="course-card">
                        <img src="<?php echo $row['img']; ?>" class="course-img" alt="Product">
                        <div class="card-body">
                            <h5 class="course-title"><?php echo $row['name']; ?></h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">৳<?php echo $row['price']; ?></span>
                                <span class="rating"><i class="fas fa-star"></i> <?php echo $row['rating_count']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
        <?php }} ?>
    </div>
</div>