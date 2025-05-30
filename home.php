<?php
$user = null;
// Include database connection
require_once 'include/dbcon.php';
if (!isset($_SESSION['number']) || !isset($_SESSION['web'])) {
    header("Location: auth.php?error=Please login first!");
    exit();
}else {
    $number = $_SESSION['number'];
    $web = decryptSt($_SESSION['web']);
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `number` = ?");
    $stmt->bind_param("s", $number);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        //reverify the password
        if (!verifyPassword($web, $user['password'])) {
            header("Location: auth.php?error=Session expired, please login again!");
            exit();
        }
    } else {
        header("Location: auth.php?error=User not found!");
        exit();
    }
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
    <!-- Header -->
    <header class="header py-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 col-7">
                    <h1 class="h5 fw-bold mb-0 header-title">Defence Academy</h1>
                </div>
                <div class="col-md-6 col-5 mt-md-0 mt-2 search-group">
                    <div class="input-group">
                        <input type="text" class="form-control search-bar" placeholder="কোর্স বা বই খুঁজুন...">
                        <button class="btn btn-primary search-btn" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-3">
        <?php
            if(isset($_GET['page'])) {
                $page = $_GET['page'];
                switch($page) {
                    case 'shop':
                        include 'section_home/shop.php';
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
                        include 'section_home/home.php';
                }
            } else {
                include 'section_home/home.php';
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
                        <span class="nav-text">হোম</span>
                    </a>
                </div>
                <div class="col">
                    <a href="?page=shop" class="nav-item">
                        <i class="fas fa-shopping-bag nav-icon"></i>
                        <span class="nav-text">শপ</span>
                    </a>
                </div>
                <div class="col">
                    <a href="?page=circular" class="nav-item">
                        <i class="fas fa-newspaper nav-icon"></i>
                        <span class="nav-text">সার্কুলার</span>
                    </a>
                </div>
                <div class="col">
                    <a href="?page=courses" class="nav-item">
                        <i class="fas fa-book nav-icon"></i>
                        <span class="nav-text">কোর্স</span>
                    </a>
                </div>
                <div class="col">
                    <a href="?page=profile" class="nav-item">
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