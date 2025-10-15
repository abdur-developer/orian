<style>
    /* Modern Slider & Category Section */
    .hero-section {        
        background-color: #fff;
        position: relative;
        padding: 100px 0 30px;
        color: black;
        overflow: hidden;
    }

    /* Modern Carousel */
    .modern-carousel {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        margin-bottom: 0.5rem;
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
    
    .modern-carousel .carousel-item{
        cursor: pointer;
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
    <!-- Search Section -->
    <div class="container mb-3 mt-1">
        <style>
            .search-bar {
                transition: box-shadow 0.3s;
            }
            .search-bar:focus-within {
                box-shadow: 0 4px 16px rgba(37,99,235,0.15);
            }
            .search-bar input::placeholder {
                color: #64748b;
                opacity: 1;
                font-size: 1rem;
            }
            .search-bar input:focus {
                background: #f1f5f9;
            }
            @media (max-width: 576px) {
                .search-bar {
                    padding: 0.25rem 0.5rem;
                }
                .search-bar input {
                    font-size: 0.95rem;
                }
            }
        </style>
        <form class="search-bar d-flex align-items-center shadow-sm rounded-pill px-3 py-2 bg-white" action="search.php" method="get" role="search" style="margin: 0 auto;">
            <input class="form-control border-0 bg-transparent flex-grow-1 px-2" type="search" name="search" placeholder="Search everything" aria-label="Search" required style="box-shadow: none; outline: none; font-size: 1.1rem;">
            <button class="btn btn-primary rounded-pill d-flex align-items-center justify-content-center ms-2" type="submit" style="min-width: 44px; min-height: 44px; box-shadow: 0 2px 8px rgba(37,99,235,0.08);">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>

    <div class="container">
        <!-- Modern Carousel -->
        <?php
            $result = $conn->query("SELECT * FROM slider");

            $carouselItems = '';
            $carouselIndicators = '';
            $index = 0;

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $active = $index === 0 ? 'active' : '';
                    $carouselItems .= "<div class='carousel-item $active' onclick=\"window.location.href='" . htmlspecialchars($row['link']) . "'\" data-bs-interval='3000'>
                        <img src='admin/upload/" . htmlspecialchars($row['img']) . "' class='d-block w-100' alt='Slide_" . ($index + 1) . "'>
                    </div>";
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
            
            <button class="carousel-control-prev" type="button" data-bs-target="#modernCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#modernCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Offer Banner -->
        <style>
            .offer-banner {
                display: flex;
                justify-content: center;
                align-items: center;
                max-height: 150px;
                margin-bottom: 1rem;
            }
            .offer-banner img{
                max-width: 100%;
                max-height: 130px;
            }
        </style>
        <div class="offer-banner">
            <?php
                $sql = "SELECT * FROM offer_banner WHERE id = 1";
                $offer = mysqli_fetch_assoc($conn->query($sql));
            ?>
            <a href="<?= htmlspecialchars($offer['link']) ?>" target="_blank" rel="noopener noreferrer">
                <img src="admin/upload/<?= htmlspecialchars($offer['img']) ?>" alt="">
            </a>
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
                    <span class="category-name">Courses</span>
                </a>                
                <a href="?products&category=8&name=Books+&+Stationery" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/5832/5832416.png">
                    </div>
                    <span class="category-name">Books</span>
                </a>                
                <!--
                <a href="?products&category=2&name=Fashion+&+Apparel" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/2954/2954918.png">
                    </div>
                    <span class="category-name">Cloth</span>
                </a>                 -->
                <a href="?products" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/3659/3659898.png">
                    </div>
                    <span class="category-name">Shopping</span>
                </a>
                <a href="home.php?page=quiz" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/10292/10292284.png">
                    </div>
                    <span class="category-name">Quiz</span>
                </a>
                <a href="home.php?page=consultants" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/8790/8790284.png">
                    </div>
                    <span class="category-name">Mentor</span>
                </a>
                <a href="home.php?page=job_apply" class="category-item">
                    <div class="category-icon">
                        <img src="	https://cdn-icons-png.flaticon.com/128/4115/4115893.png" >
                    </div>
                    <span class="category-name">Job Apply</span>
                </a>
            </div>
        </div>
        <style>
            /* পণ্য গ্রিড স্টাইল */
            #feature_product {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
                margin-bottom: 40px;
            }
            
            .product-card {
                background-color: white;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                position: relative;
                text-decoration: none;
                color: inherit;
            }
            
            .product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            }
            
            .discount-badge {
                position: absolute;
                top: 10px;
                left: 10px;
                background-color: #f57224;
                color: white;
                padding: 5px 10px;
                border-radius: 15px;
                font-size: 12px;
                font-weight: bold;
                z-index: 10;
            }
            
            .product-image {
                width: 100%;
                height: 200px;
                object-fit: cover;
                border-bottom: 1px solid #eee;
            }
            
            .product-info {
                padding: 15px;
            }
            
            .product-title {
                font-size: 18px;
                font-weight: 600;
                margin-bottom: 10px;
                height: 40px;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
            }
            
            .product-pricing {
                display: flex;
                margin-bottom: 15px;
                justify-content: space-around;
                flex-direction: column;
                align-items: center;
            }
            
            .current-price {
                color: #f57224;
                font-size: 18px;
                font-weight: bold;
            }
            
            .original-price {
                text-decoration: line-through;
                color: #999;
                font-size: 14px;
            }
            
            .add-to-cart {
                background-color: #f57224;
                color: white;
                border: none;
                padding: 10px;
                border-radius: 5px;
                width: 100%;
                cursor: pointer;
                font-weight: bold;
                transition: background-color 0.3s ease;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            
            .add-to-cart i {
                margin-right: 8px;
            }
            
            .add-to-cart:hover {
                background-color: #e0651d;
            }
            
            
            /* রেসপন্সিভ স্টাইল */            
            @media (max-width: 567px) {
                #feature_product {
                    grid-template-columns: 1fr 1fr 1fr;
                    gap: 5px;
                }
                .product-image {
                    height: 75px;
                }
                .product-title {
                    font-size: 10px;
                    padding: 2px;
                    overflow: hidden;
                    line-height: 1.5em;
                    max-height: 3em;
                }
                .product-info {
                    padding: 2px;
                }
                .product-pricing{
                    align-items: start;
                    margin-bottom: 2px;
                }
                .current-price{
                    font-size: 12px;
                }
                .original-price{
                    font-size: 9px;
                }
                .add-to-cart {
                    font-size: 10px;
                    padding: 5px;
                }
            }
            
        </style>
        <h2 class="section-title" style="margin-top: 20px;">Feature Products</h2>
        <div id="feature_product">
            <?php            
                $sql = "SELECT * FROM product WHERE is_feature = 1 LIMIT 4";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <a class="product-card" href="?product-details=<?= encryptSt($row['id']) ?>">
                        <!-- <div class="discount-badge"><= $row['status']; ?></div> -->
                        <img src="admin/upload/<?= $row['img']; ?>" class="product-image">
                        <div class="product-info">
                            <h3 class="product-title"><?= $row['name']; ?></h3>
                            <div class="product-pricing">
                                <span class="current-price">৳ <?= $row['price']; ?></span>
                                <span class="original-price">৳ <?= $row['old_price']; ?></span>
                            </div>
                            <button class="add-to-cart" onclick="addToCart('<?= encryptSt($row['id']) ?>', '<?=encryptSt($row['price'])?>')">
                                <i class="fas fa-shopping-cart"></i> Add to cart
                            </button>
                        </div>
                    </a>
                    <?php
                }
            ?>
        </div>
    </div>
</section>