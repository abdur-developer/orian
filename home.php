<?php
    $user = null;
    require_once 'include/dbcon.php';
    if (!isset($_COOKIE['number']) || !isset($_COOKIE['web'])) {
        header("Location: auth/?refer=" . urlencode(encryptSt($_SERVER['REQUEST_URI'])));//error=Please+login+first!&
        exit();
    }
    $user_id = decryptSt($_COOKIE['user_id']);
    require_once 'include/action.php';

    $web = decryptSt($_COOKIE['web']);
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        //reverify the password
        if (!verifyPassword($web, $user['password'])) {
            header("Location: auth/?error=Session+expired,+please+login+again!&refer=" . urlencode(encryptSt($_SERVER['REQUEST_URI'])));
            exit();
        }
    } else {
        header("Location: auth/?error=User+not+found!&refer=" . urlencode(encryptSt($_SERVER['REQUEST_URI'])));
        exit();
    }

?><!DOCTYPE html>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        
        .search-btn {
            border-radius: 0 20px 20px 0;
            border-left: none;
        }
        
        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .header .row {
                flex-wrap: nowrap;
            }
            .header-title {
                font-size: 1rem;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .search-group {
                min-width: 0; /* Allow shrinking */
            }
        }
        
        @media (max-width: 575.98px) {
            .header .row {
                flex-direction: column;
                gap: 10px;
            }
            .header-title, .search-group {
                width: 100%;
            }
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
            .nav-icon {
                font-size: 1.5rem;
            }            
            .nav-text {
                font-size: 12px;
            }
        }
        
    </style>

</head>
<body>
    <span id="user_id_from_local_db" class="d-none"><?= htmlspecialchars($user_id) ?></span>

    <!-- Header -->
    <header class="header py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <h1 class="h5 fw-bold mb-0 header-title">
                        <a class="navbar-brand" href="home.php">
                            <img src="img/logo.jpg" alt="ProtiSheba" class="logo img-fluid" style="height: 40px;">
                            ProtiSheba
                        </a>
                    </h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-3">
        <?php
        function home(){
            global $conn, $user_id;
            $limit = true;
            // include 'section_home/home.php';
            if(isset($_GET['view-blog'])){
                include("section/view-blog.php");

            }elseif(isset($_GET['circular-details'])){            
                include("section/view-circular.php");

            }elseif(isset($_GET['about'])){            
                include("section/about.php");

            }elseif(isset($_GET['products'])){            
                include("section/products_all.php");

            }elseif(isset($_GET['blogs'])){            
                include("section/blogs_all.php");

            }elseif(isset($_GET['course-details'])){            
                include("section/view-course.php");
                include("section/feature.php");
                include("section/testimonials.php");

            }elseif(isset($_GET['product-details'])){
                include("section/view-product.php");

            }elseif(isset($_GET['testimonials'])){
                $limit = false;
                include("section/testimonials.php");

            }else{
                echo "<style>.hero-section {padding: 0 !important;}</style>";
                include("section/hero.php");
                include("section/product.php");
                include("section/course.php");
                include("section/circular.php");
                // include("section/cta.php");                            
                include("section/blog.php");
            }
        }
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
                switch($page) {
                    case 'history':
                        include 'section_home/history.php';
                        break;
                    case 'job_apply':
                        include 'section_home/job_apply.php';
                        break;
                    case 'quiz':
                        include 'section_home/quiz.php';
                        break;
                    case 'consultants':
                        // DELETE expaire Feild
                        $sql = "DELETE FROM confirm_orders WHERE type = 'consultant' AND validity < NOW()";
                        mysqli_query($conn, $sql);
                        
                        if(availableConsultants($user_id)) {
                            include 'section_home/chat.php';
                        }else{
                            include 'section_home/consultants.php';
                        }
                        break;
                    case 'orders':
                        include 'section_home/orders.php';
                        break;
                    case 'circular':
                        include 'section_home/circular.php';
                        break;
                    case 'courses':
                        include 'section_home/course.php';
                        break;
                    case 'profile':
                        include 'section_home/profile.php';
                        break;
                    default:
                        home();
                }
            }elseif(isset($_GET['view_apply'])) {
                include 'section_home/view_apply.php';
            } else {
                home();
            }
        ?>
    </main>

    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <div class="container">
            <div class="row">
                <div class="col">
                    <a href="home.php" class="nav-item active">
                        <i class="fas fa-home nav-icon"></i>
                        <span class="nav-text">home</span>
                    </a>
                </div>
                <div class="col">
                    <a href="cart/" class="nav-item">
                        <i class="fas fa-shopping-bag nav-icon"></i>
                        <span class="nav-text">cart</span>
                    </a>
                </div>
                <div class="col">
                    <a href="?page=circular" class="nav-item">
                        <i class="fas fa-newspaper nav-icon"></i>
                        <span class="nav-text">circular</span>
                    </a>
                </div>
                <div class="col">
                    <a href="?page=courses" class="nav-item">
                        <i class="fas fa-book nav-icon"></i>
                        <span class="nav-text">course</span>
                    </a>
                </div>
                <div class="col">
                    <a href="?page=profile" class="nav-item">
                        <i class="fas fa-user nav-icon"></i>
                        <span class="nav-text">profile</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>