<?php
require 'include/dbcon.php';
$course_id = decryptSt($_GET['course']);
$sql = "SELECT * FROM course WHERE id = '$course_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    echo "Course not found.";
    exit;
}
function getTotalModule() {
    global $conn, $course_id;
    $sql = "SELECT COUNT(*) as module_count FROM course_module WHERE course_id = '$course_id'";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $row['module_count'];
}
function getTotalDetails() {
    global $conn, $course_id;
    $sql = "SELECT COUNT(md.id) AS details_count FROM course c
        JOIN course_module cm ON c.id = cm.course_id
        JOIN module_details md ON cm.id = md.module_id WHERE c.id = '$course_id'";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $row['details_count'];
}
function getDetails($module_id) {
    global $conn;
    $sql = "SELECT COUNT(*) as details_count FROM module_details WHERE module_id = '$module_id'";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $row['details_count'];
}
function getTotalTime($module_id) {
    global $conn;
    $sql = "SELECT SUM(time_minutes) as details_time FROM module_details WHERE module_id = '$module_id'";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    return $row['details_time'];
}
$course = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>এয়ার ফোর্স কমিশন্ড অফিসার কোর্স</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        
        @import url('https://fonts.googleapis.com/css2?family=Anek+Bangla:wght@100..800&display=swap');
        
        :root {
            --primary-color: #1a4b8c;
            --secondary-color: #f8f9fa;
            --accent-color: #e63946;
            --text-color: #333;
            --light-text: #6c757d;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        body {
            font-family: "Anek Bangla", sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            background-color: #f5f7fa;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color), #0d2b52);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            border-radius: 0 0 var(--border-radius) var(--border-radius);
        }
        
        .container {
            max-width: 1200px;
        }
        
        .enrolled-count {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
        }
        
        .course-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.3;
        }
        
        .course-description {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0;
        }
        
        /* Tabs */
        .tab-container {
            display: flex;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 2rem;
        }
        
        .tab {
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            font-weight: 600;
            color: var(--light-text);
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }
        
        .tab.active {
            color: var(--primary-color);
            border-bottom-color: var(--primary-color);
        }
        
        .tab:hover:not(.active) {
            color: var(--text-color);
            border-bottom-color: #adb5bd;
        }
        
        /* Section Header */
        .section-header {
            margin-bottom: 1.5rem;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        /* Course Stats */
        .course-stats {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .course-stat {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--light-text);
            font-size: 0.9rem;
        }
        
        .course-stat i {
            color: var(--primary-color);
        }
        
        /* Accordion */
        .accordion {
            --bs-accordion-border-color: #e9ecef;
            --bs-accordion-btn-padding-x: 1.25rem;
            --bs-accordion-btn-padding-y: 1rem;
            --bs-accordion-active-color: var(--primary-color);
            --bs-accordion-active-bg: #f8f9fa;
            margin-bottom: 2rem;
        }
        
        .accordion-button {
            font-weight: 600;
        }
        
        .accordion-button:not(.collapsed) {
            box-shadow: none;
        }
        
        .section-header-inner {
            width: 100%;
        }
        
        .section-title-text {
            font-size: 1rem;
            margin-bottom: 0.25rem;
            font-weight: 600;
        }
        
        .section-meta {
            font-size: 0.85rem;
            color: var(--light-text);
        }
        
        /* Lecture List */
        .lecture-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .lecture-item {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid #f1f1f1;
            transition: background-color 0.2s;
        }
        
        .lecture-item:hover {
            background-color: #f8f9fa;
        }
        
        .lecture-icon {
            margin-right: 1rem;
            color: var(--primary-color);
            font-size: 1.1rem;
        }
        
        .lecture-content {
            flex: 1;
        }
        
        .lecture-title {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        
        .lecture-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.8rem;
            color: var(--light-text);
        }
        
        .tag {
            padding: 0.2rem 0.5rem;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .tag.free {
            background-color: #e3f2fd;
            color: #1976d2;
        }
        
        .lecture-status {
            color: var(--light-text);
            font-size: 1rem;
        }
        
        .fa-lock {
            color: var(--accent-color);
        }
        
        /* Sidebar */
        .course-sidebar {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 1.5rem;
            position: sticky;
            top: 1rem;
        }
        
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            margin-bottom: 1.5rem;
            border-radius: var(--border-radius);
        }
        
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }
        
        .includes-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        
        .includes-list {
            list-style: none;
            padding: 0;
            margin-bottom: 1.5rem;
        }
        
        .includes-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
        }
        
        .includes-item img {
            width: 18px;
            margin-top: 3px;
        }
        
        /* Price */
        .price-container {
            margin-bottom: 1.5rem;
        }
        
        .current-price {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .original-price {
            font-size: 1.25rem;
            text-decoration: line-through;
            color: var(--light-text);
            margin-left: 0.5rem;
        }
        
        /* Buttons */
        .btn-enroll {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.75rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-weight: 600;
            margin-bottom: 1.5rem;
            transition: background-color 0.3s;
        }
        .instructor-profile img{
            width: 100px;
            height: 100px;
        }
        .btn-enroll:hover {
            background-color: #0d3a7a;
            color: white;
        }
        
        /* Share */
        .share-title {
            font-size: 0.9rem;
            color: var(--light-text);
            margin-bottom: 0.75rem;
            text-align: center;
        }
        
        .share-buttons {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
        }
        
        .share-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            color: white;
            font-size: 0.9rem;
            transition: transform 0.2s;
        }
        
        .share-button:hover {
            transform: translateY(-2px);
            color: white;
        }
        
        .copy { background-color: #6c757d; }
        .facebook { background-color: #3b5998; }
        .twitter { background-color: #1da1f2; }
        .email { background-color: #d44638; }
        .whatsapp { background-color: #25d366; }
        
        /* Mobile Enroll */
        .mobile-enroll {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 0.75rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        
        .mobile-price {
            display: flex;
            align-items: baseline;
            gap: 0.5rem;
        }
        
        .mobile-price .current {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .mobile-price .original {
            font-size: 0.9rem;
            text-decoration: line-through;
            color: var(--light-text);
        }
        
        .btn-mobile-enroll {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--border-radius);
            padding: 0.5rem 1.25rem;
            font-weight: 600;
        }
        
        /* Responsive */
        @media (max-width: 991.98px) {
            .course-title {
                font-size: 1.8rem;
            }
            
            .course-description {
                font-size: 1rem;
            }
        }
        
        @media (max-width: 767.98px) {
            .hero-section {
                padding: 2rem 0;
            }
            
            .tab-container {
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 0.5rem;
            }
            
            .tab {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
            
            .course-stats {
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="enrolled-count">
                <i class="fas fa-users"></i>
                <span><?=$course['users']?> Students Enrolled</span>
            </div>
            <h1 class="course-title"><?=$course['title']?></h1>
            <p class="course-description"><?=$course['description']?></p>
        </div>
    </section>

    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Tabs -->
                <div class="tab-container">
                    <div class="tab active" data-tab="curriculum">কোর্স পাঠ্যক্রম</div>
                    <div class="tab" data-tab="overview">কোর্স ওভারভিউ</div>
                    <!-- <div class="tab" data-tab="instructor">প্রশিক্ষক</div>
                    <div class="tab" data-tab="reviews">কোর্স রিভিউ</div> -->
                </div>
                
                <!-- Tab Contents -->
                <div class="tab-content active" id="curriculum">
                    <!-- Curriculum Section -->
                    <div class="section-header">
                        <h2 class="section-title">কোর্স পাঠ্যক্রম</h2>
                    </div>
                    
                    <div class="course-stats">
                        <div class="course-stat">
                            <i class="fas fa-list-ul"></i>
                            <span><?= getTotalModule() ?> সেকশন</span>
                        </div>
                        <div class="course-stat">
                            <i class="fas fa-play-circle"></i>
                            <span><?= getTotalDetails() ?> লেকচার</span>
                        </div>
                    </div>
                    <div class="accordion" id="courseAccordion">
                        <?php
                            $sql = "SELECT * FROM course_module WHERE course_id = '$course_id'";
                            $result_module = mysqli_query($conn, $sql);
                            while ($course_module = mysqli_fetch_assoc($result_module)) { ?>
                                <!-- ================================================== -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#section1">
                                            <div class="section-header-inner">
                                                <h3 class="section-title-text"><?=$course_module['title']?></h3>
                                                <div class="section-meta">
                                                    <span><?=getDetails($course_module['id'])?> লেকচার</span>
                                                    <span>•</span>
                                                    <span><?=getTotalTime($course_module['id'])?> মিনিট</span>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="section1" class="accordion-collapse collapse" data-bs-parent="#courseAccordion">
                                        <div class="accordion-body p-0">
                                            <ul class="lecture-list">
                                                <!-- ////////////////////////////////////////////////////////// -->
                                                <?php
                                                    $sql = "SELECT * FROM `module_details` WHERE module_id = '{$course_module['id']}'";
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($module_details = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <li class="lecture-item">
                                                    <div class="lecture-icon">
                                                        <i class="fas fa-play-circle"></i>
                                                    </div>
                                                    <div class="lecture-content">
                                                        <div class="lecture-title"><?=$module_details['title']?></div>
                                                        <div class="lecture-meta">
                                                            <?php if($module_details['is_free'] != '0') echo "<span class='tag free'>ফ্রি প্রিভিউ</span>"; ?>
                                                            <span class="lecture-duration"><?=$module_details['time_minutes']?> মিনিট</span>
                                                        </div>
                                                    </div>
                                                    <?php
                                                        // echo "<i class='fas fa-check-circle lecture-status'></i>"; // completed
                                                        if($module_details['is_free'] != '0') {
                                                            echo "<i class='fas fa-eye lecture-status'></i>";
                                                        } else {
                                                            echo "<i class='fas fa-lock lecture-status'></i>";
                                                        }
                                                    ?>                                          
                                                </li>
                                                <?php } ?>
                                                <!-- ////////////////////////////////////////////////////////// -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- ================================================== -->
                        <?php } ?>
                    </div>                    
                </div>
                
                <!-- Overview Tab Content (hidden by default) -->
                <div class="tab-content" id="overview" style="display: none;">
                    <div class="section-header">
                        <h2 class="section-title">কোর্স ওভারভিউ</h2>
                    </div>
                    <div class="course-overview"><?=$course['overview']?></div>
                </div>
                
                <!-- Instructor Tab Content (hidden by default) -->
                <!-- <div class="tab-content" id="instructor" style="display: none;">
                    <div class="section-header">
                        <h2 class="section-title">প্রশিক্ষক</h2>
                    </div>
                    <div class="instructor-profile">
                        <div class="d-flex align-items-center mb-4">
                            <img src="https://img.freepik.com/premium-photo/young-asian-teacher-man-teaching-video-conference-with-student_208349-913.jpg" alt="Instructor" class="rounded-circle me-3">
                            <div>
                                <h3>কর্নেল (অব.) মোঃ রফিকুল ইসলাম</h3>
                                <p class="text-muted mb-2">বাংলাদেশ বিমানবাহিনী, অবসরপ্রাপ্ত</p>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-star text-warning me-1"></i>
                                    <span class="me-2">4.9</span>
                                    <i class="fas fa-users me-1"></i>
                                    <span>475 শিক্ষার্থী</span>
                                </div>
                            </div>
                        </div>
                        <div class="instructor-bio">
                            <p>কর্নেল (অব.) মোঃ রফিকুল ইসলাম বাংলাদেশ বিমানবাহিনীতে ২৫ বছর সক্রিয় দায়িত্ব পালন করেছেন। তিনি বিমানবাহিনী সিলেকশন বোর্ডের সদস্য হিসেবে দায়িত্ব পালন করেছেন এবং শতাধিক ক্যান্ডিডেটের ইন্টারভিউ নিয়েছেন। তাঁর অভিজ্ঞতা ও জ্ঞান এই কোর্সের মাধ্যমে শিক্ষার্থীদের সাথে শেয়ার করা হবে।</p>
                        </div>
                    </div>
                </div> -->
                
                <!-- Reviews Tab Content (hidden by default) -->
                <!-- <div class="tab-content" id="reviews" style="display: none;">
                    <div class="section-header">
                        <h2 class="section-title">কোর্স রিভিউ</h2>
                    </div>
                    <div class="course-reviews">
                        <div class="review-summary mb-4 p-3 bg-light rounded">
                            <div class="d-flex align-items-center mb-2">
                                <h3 class="mb-0 me-2">4.9</h3>
                                <div>
                                    <div class="stars mb-1">
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star text-warning"></i>
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    </div>
                                    <p class="text-muted mb-0">মোট ৪৭টি রিভিউ</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="review-list">
                            <div class="review-item mb-4 pb-3 border-bottom">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <h4 class="mb-1">আহমেদ রিয়াদ</h4>
                                        <div class="stars">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <span class="text-muted">2 সপ্তাহ আগে</span>
                                </div>
                                <p>এই কোর্সটি আমার বিমানবাহিনীতে যোগদানের স্বপ্ন পূরণে অত্যন্ত সহায়ক হয়েছে। প্রশিক্ষক মহোদয়ের অভিজ্ঞতালব্ধ জ্ঞান এবং ব্যবহারিক টিপসগুলো খুবই কার্যকরী।</p>
                            </div>
                            
                            <div class="review-item mb-4 pb-3 border-bottom">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        <h4 class="mb-1">সুমাইয়া আক্তার</h4>
                                        <div class="stars">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <span class="text-muted">1 মাস আগে</span>
                                </div>
                                <p>ভাইভা প্রস্তুতির জন্য যেসব টিপস দেওয়া হয়েছে সেগুলো সত্যিই অসাধারণ। আমি আমার ইন্টারভিউতে এই কোর্স থেকে শেখা প্রশ্নগুলোর সম্মুখীন হয়েছি এবং সফল হয়েছি।</p>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="course-sidebar">
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/<?=$course['feature_video_id']?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    
                    <h3 class="includes-title">এই কোর্সে যা পাচ্ছেন :</h3>
                    <ul class="includes-list">
                        <?php 
                            $decoded = json_decode($course['ki_thakbe'], true);
                            foreach ($decoded as $item) {
                        ?>
                        <li class="includes-item">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span><?=$item?></span>
                        </li>
                        <?php } ?>
                    </ul>
                    
                    <div class="price-container">
                        <span class="current-price"><?=$course['price']?>৳</span>
                        <span class="original-price"><?=$course['old_price']?>৳</span>
                    </div>
                    
                    <button class="btn-enroll">
                        <i class="fas fa-arrow-right-to-bracket me-2"></i>এনরোল করুন
                    </button>
                    
                    <div class="share-title">কোর্স শেয়ার করুন</div>
                    <div class="share-buttons">
                        <a href="#" class="share-button copy">
                            <i class="fas fa-link"></i>
                        </a>
                        <a href="#" class="share-button facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="share-button twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="share-button email">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <a href="#" class="share-button whatsapp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mobile Enroll Button -->
    <div class="mobile-enroll d-lg-none">
        <div class="mobile-price">
            <span class="current">4000৳</span>
            <span class="original">6000৳</span>
        </div>
        <button class="btn-mobile-enroll">এনরোল করুন</button>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-expand first section
            const firstSection = document.querySelector('.accordion-item');
            if (firstSection) {
                const collapse = new bootstrap.Collapse(firstSection.querySelector('.accordion-collapse'));
                collapse.show();
            }
            
            // Tab functionality
            const tabs = document.querySelectorAll('.tab');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Hide all tab contents
                    tabContents.forEach(content => {
                        content.style.display = 'none';
                    });
                    
                    // Show the corresponding tab content
                    const tabId = this.getAttribute('data-tab');
                    document.getElementById(tabId).style.display = 'block';
                });
            });
            
            // Copy link functionality
            const copyButton = document.querySelector('.share-button.copy');
            if (copyButton) {
                copyButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = window.location.href;
                    navigator.clipboard.writeText(url).then(() => {
                        alert('লিংক কপি করা হয়েছে!');
                    });
                });
            }
        });
    </script>
</body>
</html>