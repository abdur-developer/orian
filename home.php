<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>শিক্ষা - আপনার অনলাইন লার্নিং প্ল্যাটফর্ম</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts - Bengali -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #f8f9fa;
            --text-color: #333;
            --light-text: #6c757d;
        }
        
        body {
            font-family: 'Hind Siliguri', sans-serif;
            color: var(--text-color);
            padding-bottom: 70px; /* Space for bottom nav */
            background-color: #f5f5f5;
        }
        .card-body{
          padding: 10px 20px;
        }
        /* Header Styles */
        .header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .search-bar {
            border-radius: 20px;
            border: 1px solid #ddd;
            padding-left: 15px;
            font-size: 14px;
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
        
        /* Bottom Navigation */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: white;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
            z-index: 1000;
            padding: 10px 0;
        }
        
        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: var(--light-text);
        }
        
        .nav-icon {
            font-size: 1.2rem;
        }
        
        .nav-text {
            font-size: 11px;
            margin-top: 3px;
        }
        
        .nav-item.active {
            color: var(--primary-color);
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
            
            .nav-icon {
                font-size: 1.5rem;
            }
            
            .nav-text {
                font-size: 12px;
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
</head>
<body>
    <!-- Header -->
    <header class="header py-3">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h5 fw-bold mb-0">শিক্ষা</h1>
            </div>
            <div class="mt-3">
                <div class="input-group">
                    <input type="text" class="form-control search-bar" placeholder="কোর্স বা বই খুঁজুন...">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-3">
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
                <!-- Course 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <img src="https://images.unsplash.com/photo-1546410531-bb4caa6b424d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="course-img" alt="Course">
                        <div class="card-body">
                            <h5 class="course-title">আর্মি জব প্রিপারেশন ক্র্যাশ কোর্স</h5>
                            <p class="instructor mb-2">ডিফেন্স ২৪ বিডি</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">৳২৪০০</span>
                                <span class="rating"><i class="fas fa-star"></i> ৪.৫</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Course 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="course-img" alt="Course">
                        <div class="card-body">
                            <h5 class="course-title">ওয়েব ডেভেলপমেন্ট বুটক্যাম্প</h5>
                            <p class="instructor mb-2">প্রোগ্রামিং হিরো</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">৳৩৫০০</span>
                                <span class="rating"><i class="fas fa-star"></i> ৪.৮</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Course 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="course-img" alt="Course">
                        <div class="card-body">
                            <h5 class="course-title">গ্রাফিক ডিজাইন মাস্টারক্লাস</h5>
                            <p class="instructor mb-2">ক্রিয়েটিভ লার্নিং</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">৳২৮০০</span>
                                <span class="rating"><i class="fas fa-star"></i> ৪.৭</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Now Section -->
        <div class="category-section">
            <h2 class="h5 fw-bold mb-3">অর্ডার করুন</h2>
            <div class="row g-3">
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="course-card">
                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="course-img" alt="Product">
                        <div class="card-body">
                            <h5 class="course-title">প্রোগ্রামিং বই</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">৳৪৫০</span>
                                <span class="rating"><i class="fas fa-star"></i> ৪.৩</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="course-card">
                        <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="course-img" alt="Product">
                        <div class="card-body">
                            <h5 class="course-title">স্কুল ইউনিফর্ম</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">৳৮০০</span>
                                <span class="rating"><i class="fas fa-star"></i> ৪.৫</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="course-card">
                        <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="course-img" alt="Product">
                        <div class="card-body">
                            <h5 class="course-title">স্মার্টওয়াচ</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">৳৩২০০</span>
                                <span class="rating"><i class="fas fa-star"></i> ৪.২</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="course-card">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="course-img" alt="Product">
                        <div class="card-body">
                            <h5 class="course-title">হেডফোন</h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="price">৳১৫০০</span>
                                <span class="rating"><i class="fas fa-star"></i> ৪.৬</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="#" class="nav-item active">
                        <i class="fas fa-home nav-icon"></i>
                        <span class="nav-text">হোম</span>
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="nav-item">
                        <i class="fas fa-shopping-bag nav-icon"></i>
                        <span class="nav-text">শপ</span>
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="nav-item">
                        <i class="fas fa-newspaper nav-icon"></i>
                        <span class="nav-text">সার্কুলার</span>
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="nav-item">
                        <i class="fas fa-book nav-icon"></i>
                        <span class="nav-text">কোর্স</span>
                    </a>
                </div>
                <div class="col">
                    <a href="#" class="nav-item">
                        <i class="fas fa-user nav-icon"></i>
                        <span class="nav-text">প্রোফাইল</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>