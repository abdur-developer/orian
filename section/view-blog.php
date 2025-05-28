
<style>

    /* Blog View Page Styles */
    .blog-view-page {
        padding: 80px 0 60px;
        background-color: #f8f9fa;
    }
    
    .blog-container {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 40px;
    }
    
    .main-blog {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }
    
    .blog-header-image {
        height: 400px;
        overflow: hidden;
    }
    
    .blog-header-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .blog-content-wrapper {
        padding: 40px;
    }
    
    .blog-meta {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    
    .blog-date {
        background: var(--primary);
        color: white;
        padding: 5px 15px;
        border-radius: 30px;
        font-size: 0.9rem;
        margin-right: 15px;
    }
    
    .blog-category {
        background: #e9ecef;
        color: #495057;
        padding: 5px 15px;
        border-radius: 30px;
        font-size: 0.9rem;
    }
    
    .blog-title {
        font-size: 2rem;
        color: #2c3e50;
        margin-bottom: 20px;
        font-weight: 700;
        line-height: 1.3;
    }
    
    .blog-content {
        color: #495057;
        line-height: 1.8;
        font-size: 1.1rem;
    }
    
    .blog-content p {
        margin-bottom: 20px;
    }
    
    .blog-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 30px 0;
    }
    
    .blog-content h2, 
    .blog-content h3 {
        color: #2c3e50;
        margin: 30px 0 20px;
    }
    
    .blog-content h2 {
        font-size: 1.6rem;
    }
    
    .blog-content h3 {
        font-size: 1.4rem;
    }
    
    /* Sidebar Styles */
    .blog-sidebar {
        background: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        height: fit-content;
    }
    
    .sidebar-title {
        font-size: 1.3rem;
        color: #2c3e50;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--primary);
    }
    
    .related-blog {
        display: flex;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .related-blog:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    
    .related-blog-image {
        width: 80px;
        height: 80px;
        border-radius: 6px;
        overflow: hidden;
        margin-right: 15px;
        flex-shrink: 0;
    }
    
    .related-blog-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .related-blog-content h4 {
        font-size: 1rem;
        margin-bottom: 5px;
        line-height: 1.4;
    }
    
    .related-blog-content h4 a {
        color: #2c3e50;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .related-blog-content h4 a:hover {
        color: var(--primary);
    }
    
    .related-blog-date {
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    /* Tags Section */
    .tags-section {
        margin-top: 40px;
    }
    
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }
    
    .tag {
        display: inline-block;
        background: #e9ecef;
        color: #495057;
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .tag:hover {
        background: var(--primary);
        color: white;
    }
    
    /* Footer Styles */
    .footer {
        background-color: #2c3e50;
        color: white;
        padding: 50px 0 20px;
    }
    
    .footer-logo {
        margin-bottom: 20px;
    }
    
    .footer-links h5 {
        font-size: 1.2rem;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }
    
    .footer-links h5::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 2px;
        background: var(--primary);
    }
    
    .footer-links ul {
        list-style: none;
        padding-left: 0;
    }
    
    .footer-links li {
        margin-bottom: 10px;
    }
    
    .footer-links a {
        color: #adb5bd;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .footer-links a:hover {
        color: white;
        padding-left: 5px;
    }
    
    .social-icons a {
        display: inline-block;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border-radius: 50%;
        text-align: center;
        line-height: 40px;
        margin-right: 10px;
        transition: all 0.3s ease;
    }
    
    .social-icons a:hover {
        background: var(--primary);
        transform: translateY(-3px);
    }
    
    .copyright {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 20px;
        margin-top: 30px;
        text-align: center;
        color: #adb5bd;
        font-size: 0.9rem;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .blog-container {
            grid-template-columns: 1fr;
        }
        
        .blog-sidebar {
            margin-top: 40px;
        }
    }
    
    @media (max-width: 768px) {
        .blog-view-page {
            padding: 60px 0 40px;
        }
        
        .blog-header-image {
            height: 250px;
        }
        
        .blog-content-wrapper {
            padding: 25px;
        }
        
        .blog-title {
            font-size: 1.6rem;
        }
    }
    
    @media (max-width: 576px) {
        .blog-meta {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .blog-date {
            margin-bottom: 10px;
            margin-right: 0;
        }
        
        .related-blog {
            flex-direction: column;
        }
        
        .related-blog-image {
            width: 100%;
            height: 150px;
            margin-right: 0;
            margin-bottom: 15px;
        }
    }
</style>
<?php
    // Fetch the blog post details from the database
    $id = $_GET['view-blog'];
    $sql = "SELECT * FROM post WHERE id = '$id'";
    $post = mysqli_fetch_assoc(mysqli_query($conn, $sql));
?>
<!-- Blog View Page Content -->
<section class="blog-view-page">
    <div class="container">
        <div class="blog-container">
            <!-- Main Blog Content -->
            <div class="main-blog">
                <div class="blog-header-image">
                    <img src="<?= $post['img'] ?>">
                </div>
                
                <div class="blog-content-wrapper">
                    <div class="blog-meta">
                        <span class="blog-date"><?= $post['date']; ?></span>
                        <span class="blog-category"><?= $post['category']; ?></span>
                    </div>
                    
                    <h1 class="blog-title"><?= $post['title']; ?></h1>
                    
                    <div class="blog-content">
                        <?= $post['text']; ?>
                    </div>
                </div>
            </div>
            
            <!-- Blog Sidebar -->
            <div class="blog-sidebar">
                <h3 class="sidebar-title">সম্পর্কিত ব্লগ পোস্ট</h3>
                <?php
                // Fetch related blog posts (for simplicity, fetching the first 3 posts)    
                $relatedPosts = mysqli_query($conn, "SELECT id, img, title, date FROM post WHERE id != '$id' LIMIT 3");
                while($relatedPost = mysqli_fetch_assoc($relatedPosts)) {
                    ?>
                    <div class="related-blog">
                        <div class="related-blog-image">
                            <img src="<?= $relatedPost['img'] ?>">
                        </div>
                        <div class="related-blog-content">
                            <h4><a href="?view-blog=<?= $relatedPost['id'] ?>"><?= $relatedPost['title'] ?></a></h4>
                            <div class="related-blog-date"><?= $relatedPost['date'] ?></div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                
                <!-- Tags Section -->
                <div class="tags-section">
                    <h3 class="sidebar-title">ট্যাগসমূহ</h3>
                    <div class="tags-container">
                        <?php
                        $tags = explode(',', $post['tags']);
                        foreach($tags as $tag) {
                            echo '<a href="#" class="tag">' . trim($tag) . '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>