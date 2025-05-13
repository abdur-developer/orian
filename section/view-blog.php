
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

<!-- Blog View Page Content -->
<section class="blog-view-page">
    <div class="container">
        <div class="blog-container">
            <!-- Main Blog Content -->
            <div class="main-blog">
                <div class="blog-header-image">
                    <img src="https://images.unsplash.com/photo-1588072432836-e10032774350?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1472&q=80" alt="ডিফেন্স প্রস্তুতি গাইড">
                </div>
                
                <div class="blog-content-wrapper">
                    <div class="blog-meta">
                        <span class="blog-date">১৫ জুন, ২০২৩</span>
                        <span class="blog-category">ডিফেন্স গাইড</span>
                    </div>
                    
                    <h1 class="blog-title">বিসিএস ও অন্যান্য ডিফেন্স পরীক্ষার প্রস্তুতি কীভাবে নেবেন</h1>
                    
                    <div class="blog-content">
                        <p>ডিফেন্স পরীক্ষার প্রস্তুতি একটি দীর্ঘমেয়াদী প্রক্রিয়া যার জন্য প্রয়োজন সঠিক পরিকল্পনা, নিয়মানুবর্তিতা এবং ধৈর্য্য। এই গাইডে আমরা বিস্তারিতভাবে আলোচনা করব কিভাবে আপনি ডিফেন্স পরীক্ষার জন্য কার্যকরী প্রস্তুতি নিতে পারেন।</p>
                        
                        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="ডিফেন্স প্রস্তুতি">
                        
                        <h2>প্রথম ধাপ: সিলেবাস বিশ্লেষণ</h2>
                        <p>যেকোনো পরীক্ষার প্রস্তুতির প্রথম ধাপ হলো সিলেবাস ভালোভাবে বুঝে নেওয়া। বিসিএস ও অন্যান্য ডিফেন্স পরীক্ষার সিলেবাস সাধারণত তিনটি মূল বিভাগে বিভক্ত:</p>
                        <ul>
                            <li>লিখিত পরীক্ষা</li>
                            <li>মৌখিক পরীক্ষা</li>
                            <li>শারীরিক পরীক্ষা</li>
                        </ul>
                        
                        <h3>লিখিত পরীক্ষার প্রস্তুতি</h3>
                        <p>লিখিত পরীক্ষার জন্য আপনাকে বাংলা, ইংরেজি, গণিত, সাধারণ জ্ঞান এবং বিষয়ভিত্তিক প্রশ্নের জন্য প্রস্তুতি নিতে হবে। প্রতিটি বিষয়ের জন্য আলাদা আলাদা সময় বরাদ্দ করুন।</p>
                        
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="লিখিত পরীক্ষার প্রস্তুতি">
                        
                        <h3>মৌখিক পরীক্ষার টিপস</h3>
                        <p>মৌখিক পরীক্ষায় সাধারণত আপনার ব্যক্তিত্ব, যোগাযোগ দক্ষতা এবং দ্রুত চিন্তা করার ক্ষমতা যাচাই করা হয়। নিয়মিত সংবাদপত্র পড়ুন এবং বন্ধুদের সাথে মক ইন্টারভিউ অনুশীলন করুন।</p>
                        
                        <h2>দ্বিতীয় ধাপ: সময় ব্যবস্থাপনা</h2>
                        <p>একটি কার্যকরী সময়সূচী তৈরি করুন যেখানে প্রতিদিনের পড়ার রুটিন, রিভিশন এবং মডেল টেস্ট দেয়ার সময় নির্ধারণ করা থাকবে। সপ্তাহে অন্তত একটি দিন নিজেকে মূল্যায়ন করুন।</p>
                        
                        <h2>তৃতীয় ধাপ: শারীরিক প্রস্তুতি</h2>
                        <p>ডিফেন্স চাকরির জন্য শারীরিক ফিটনেস অপরিহার্য। প্রতিদিন সকালে দৌড়ানো, ব্যায়াম এবং সাঁতার কাটার অভ্যাস গড়ে তুলুন।</p>
                    </div>
                </div>
            </div>
            
            <!-- Blog Sidebar -->
            <div class="blog-sidebar">
                <h3 class="sidebar-title">সম্পর্কিত ব্লগ পোস্ট</h3>
                
                <div class="related-blog">
                    <div class="related-blog-image">
                        <img src="https://images.unsplash.com/photo-1521791055366-0d553872125f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1469&q=80" alt="ইন্টারভিউ টিপস">
                    </div>
                    <div class="related-blog-content">
                        <h4><a href="/bn/blog/post-2">ডিফেন্স চাকরির ইন্টারভিউতে সফল হবার ১০টি টিপস</a></h4>
                        <div class="related-blog-date">২৮ মে, ২০২৩</div>
                    </div>
                </div>
                
                <div class="related-blog">
                    <div class="related-blog-image">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="শারীরিক প্রস্তুতি">
                    </div>
                    <div class="related-blog-content">
                        <h4><a href="/bn/blog/post-3">ডিফেন্স চাকরির জন্য শারীরিক প্রস্তুতি কীভাবে নেবেন</a></h4>
                        <div class="related-blog-date">১০ মে, ২০২৩</div>
                    </div>
                </div>
                
                <div class="related-blog">
                    <div class="related-blog-image">
                        <img src="https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="সাইকোলজিক্যাল টেস্ট">
                    </div>
                    <div class="related-blog-content">
                        <h4><a href="/bn/blog/post-4">ডিফেন্স চাকরির সাইকোলজিক্যাল টেস্টের প্রস্তুতি</a></h4>
                        <div class="related-blog-date">২৫ এপ্রিল, ২০২৩</div>
                    </div>
                </div>
                
                <!-- Tags Section -->
                <div class="tags-section">
                    <h3 class="sidebar-title">ট্যাগসমূহ</h3>
                    <div class="tags-container">
                        <a href="#" class="tag">ডিফেন্স গাইড</a>
                        <a href="#" class="tag">বিসিএস প্রস্তুতি</a>
                        <a href="#" class="tag">ইন্টারভিউ টিপস</a>
                        <a href="#" class="tag">শারীরিক প্রস্তুতি</a>
                        <a href="#" class="tag">সময় ব্যবস্থাপনা</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>