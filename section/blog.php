<style>
    /* Blog Section Styles */
    .blog-section {
        padding: 80px 0;
        background-color: #f8f9fa;
    }
    
    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }
    
    .section-title h2 {
        font-size: 2.5rem;
        color: #2c3e50;
        margin-bottom: 15px;
        font-weight: 700;
    }
    
    .section-title p {
        color: #7f8c8d;
        font-size: 1.1rem;
        max-width: 700px;
        margin: 0 auto;
    }
    
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        margin-top: 30px;
    }
    
    .blog-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }
    
    .blog-image {
        height: 200px;
        overflow: hidden;
    }
    
    .blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .blog-card:hover .blog-image img {
        transform: scale(1.1);
    }
    
    .blog-content {
        padding: 25px;
    }
    
    .blog-date {
        display: inline-block;
        background: var(--primary);
        color: white;
        padding: 5px 15px;
        border-radius: 30px;
        font-size: 0.8rem;
        margin-bottom: 15px;
    }
    
    .blog-title {
        font-size: 1.3rem;
        color: #2c3e50;
        margin-bottom: 10px;
        font-weight: 600;
        line-height: 1.4;
    }
    
    .blog-excerpt {
        color: #7f8c8d;
        margin-bottom: 15px;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.5em; /* Optional: controls line height */
        max-height: 4.5em; /* Optional: controls max height */
    }
    
    .read-more {
        display: inline-flex;
        align-items: center;
        color: var(--primary);
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .read-more i {
        margin-left: 5px;
        transition: transform 0.3s ease;
    }
    
    .read-more:hover {
        color: var(--primary-dark);
    }
    
    .read-more:hover i {
        transform: translateX(3px);
    }
    
    .view-all-btn {
        display: block;
        text-align: center;
        margin-top: 50px;
    }
    
    .view-all-btn .btn {
        padding: 12px 30px;
        font-size: 1rem;
        font-weight: 500;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .blog-section {
            padding: 60px 0;
        }
        
        .section-title h2 {
            font-size: 2rem;
        }
        
        .blog-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="blog-section">
    <!-- Blog Section -->
    <div class="container">
        <div class="section-title">
            <h2>আমাদের ব্লগ</h2>
            <p>ডিফেন্স প্রস্তুতি সম্পর্কিত সর্বশেষ টিপস, গাইড এবং আপডেট পড়ুন</p>
        </div>
        
        <div class="blog-grid">
            <?php 
            $sql = "SELECT id, img, title, date, sort_text FROM post";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){ ?>
            <div class="blog-card">
                <div class="blog-image">
                    <img src="<?=$row['img']?>" >
                </div>
                <div class="blog-content">
                    <span class="blog-date"><?=$row['date']?></span>
                    <h3 class="blog-title"><?=$row['title']?></h3>
                    <p class="blog-excerpt"><?= htmlspecialchars($row['sort_text'])?>।</p>
                    <a href="?view-blog=<?=$row['id']?>" class="read-more">
                        আরও পড়ুন <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
        
        <div class="view-all-btn">
            <a href="/bn/blog" class="btn btn-primary">
                সব ব্লগ পোস্ট দেখুন <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
    
    <!-- Circuler Section -->
    <div class="container" style="margin-top: 50px;">
        <div class="section-title">
            <h2>সার্কুলার</h2>
            <p>সর্বশেষ সার্কুলার এবং নোটিশসমূহ দেখুন</p>        
        <div class="blog-grid">
            <?php 
            $sql = "SELECT id, img, title, description, dateline FROM circulars";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){ ?>
            <div class="blog-card">
                <div class="blog-image">
                    <img src="<?=$row['img']?>" >
                </div>
                <div class="blog-content">
                    <span class="blog-date"><?=$row['dateline']?></span>
                    <h3 class="blog-title"><?=$row['title']?></h3>
                    <p class="blog-excerpt"><?=$row['description']?>।</p>
                    <a href="?view-blog=<?=$row['id']?>" class="read-more">
                        আরও পড়ুন <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php } ?>
        </div>
        
        <div class="view-all-btn">
            <a href="/bn/blog" class="btn btn-primary">
                সব ব্লগ পোস্ট দেখুন <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>