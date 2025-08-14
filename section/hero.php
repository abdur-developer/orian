<style>
    /* Modern Slider & Category Section */
    .hero-section {        
        background-color: #fff;
        position: relative;
        padding: 100px 0;
        color: black;
        overflow: hidden;
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
    
    /* Category Section */
    .category-section {
        position: relative;
    }
    
    .category-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .category-title h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        position: relative;
        padding-left: 15px;
    }
    
    .category-title h2:before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 20px;
        background: #2563eb;
        border-radius: 3px;
    }
    
    .category-title .view-all {
        color: #2563eb;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .category-title .view-all:hover {
        color: #1d4ed8;
        transform: translateX(5px);
    }
    
    .category-title .view-all i {
        margin-left: 5px;
        transition: all 0.3s ease;
    }
    
    .category-title .view-all:hover i {
        transform: translateX(3px);
    }
    
    .category-scroll {
        display: flex;
        flex-wrap: wrap;
        padding-bottom: 1rem;
        overflow-x: auto;
        scrollbar-width: none; /* Firefox */
        justify-content: space-around;
    }

    .category-scroll::-webkit-scrollbar {
        display: none; /* Chrome/Safari */
    }
    
    .category-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 90px;
        margin-right: 1.5rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .category-item:last-child {
        margin-right: 0;
    }
    
    .category-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        margin-bottom: 12px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .category-icon img {
        width: 40px;
        height: 40px;
        object-fit: contain;
        transition: all 0.3s ease;
    }
    
    .category-icon:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: #2563eb;
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s ease;
    }
    
    .category-item:hover .category-icon {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.15);
    }
    
    .category-item:hover .category-icon:after {
        transform: scaleX(1);
        transform-origin: left;
    }
    
    .category-item:hover .category-icon img {
        transform: scale(1.1);
    }
    
    .category-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: #334155;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .category-item:hover .category-name {
        color: #2563eb;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .modern-carousel img {
            height: 220px;
        }
        
        .category-item {
            min-width: 80px;
            margin-right: 1rem;
        }
        
        .category-icon {
            width: 60px;
            height: 60px;
        }
        
        .category-icon img {
            width: 35px;
            height: 35px;
        }
    }
</style>

<!-- Modern Slider & Category Section -->
<section class="hero-section">
    <div class="container">
        <!-- Modern Carousel -->
        <?php
            $sql = "SELECT img FROM slider";
            $result = $conn->query($sql);

            $carouselItems = '';
            $carouselIndicators = '';
            $index = 0;

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $active = $index === 0 ? 'active' : '';
                    $carouselItems .= "<div class='carousel-item $active'><img src='" . htmlspecialchars($row['img']) . "' class='d-block w-100' alt='Slide " . ($index + 1) . "'></div>";
                    $carouselIndicators .= "<button type='button' data-bs-target='#modernCarousel' data-bs-slide-to='$index'" . ($index === 0 ? " class='active'" : "") . "></button>";

                    $index++;
                }
            } else {
                // Fallback if no images found
                $carouselItems = '<div class="carousel-item active"><img src="https://picsum.photos/600" class="d-block w-100" alt="No Images"></div>';
                $carouselIndicators = '<button type="button" data-bs-target="#modernCarousel" data-bs-slide-to="0" class="active"></button>';
            }
        ?>

        <div id="modernCarousel" class="carousel slide modern-carousel" data-bs-ride="carousel">
            <div class="carousel-inner"><?= $carouselItems; ?></div>
            <div class="carousel-indicators"><?= $carouselIndicators; ?></div>
        </div>

        <!-- Modern Category Section -->
        <div class="category-section">
            <div class="category-title">
                <h2>Browse Categories</h2>
                <!-- <a href="#" class="view-all">View All <i class="fas fa-arrow-right"></i></a> -->
            </div>
            
            <div class="category-scroll">
                <a href="#courses" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/2997/2997592.png">
                    </div>
                    <span class="category-name">কোর্স</span>
                </a>                
                <!-- <a href="?product#product" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/5832/5832416.png">
                    </div>
                    <span class="category-name">বই</span>
                </a>                
                <a href="?product#product" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/2954/2954918.png">
                    </div>
                    <span class="category-name">পোশাক</span>
                </a>                 -->
                <a href="?product#product" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/3659/3659898.png">
                    </div>
                    <span class="category-name">কেনাকাটা</span>
                </a>
                <a href="home.php?page=quiz" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/10292/10292284.png">
                    </div>
                    <span class="category-name">কুইজ</span>
                </a>
                <a href="home.php?page=consultants" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/8790/8790284.png">
                    </div>
                    <span class="category-name">পরামর্শদাতা</span>
                </a>
                <a href="home.php?page=job_apply" class="category-item">
                    <div class="category-icon">
                        <img src="	https://cdn-icons-png.flaticon.com/128/4115/4115893.png" >
                    </div>
                    <span class="category-name">জব এ্যা‌প্লাই</span>
                </a>
            </div>
        </div>
    </div>
</section>