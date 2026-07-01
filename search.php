<?php include("section/header.php"); ?>

<body>
    <style>
        .search-header {
            background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);
            padding: 10px;
            text-align: center;
            box-shadow: 0 6px 32px rgba(78,84,200,0.18);
            margin: 0 auto 28px;
            max-width: 100%;
            position: relative;
            overflow: hidden;
        }
        .search-header h3 {
            color: #fff;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin: 0;
            text-shadow: 0 2px 12px rgba(78,84,200,0.18);
        }
        .search-header .search-term-highlight {
            background: rgba(255,255,255,0.18);
            padding: 10px 28px;
            border-radius: 10px;
            display: inline-block;
            transition: background 0.3s;
        }
        .search-header .search-term {
            color: #ffe082;
            font-weight: 900;
            font-size: 1.2em;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 4px rgba(0,0,0,0.08);
        }
    </style>

    <?php
        $limit = false;
        $searchTerm = null;
        require "include/dbcon.php";

        if(isset($_GET['search']) && !empty(trim($_GET['search']))){
            $searchTerm = htmlspecialchars(trim($_GET['search']));
            ?>
            <section class="search-header">
                <h3 class="search-term-highlight">🔍 Search Results for: <span class="search-term"><?=$searchTerm?></span></h3>
            </section>
            <?php
                include("section/product.php");
                include("section/course.php");
                include("section/circular.php");
                include("section/blog.php");
            ?>
            <?php
        }else{ ?>
            <section class="search-header">
                <h3 class="search-term-highlight">🔍 Search Results</h3>
            </section>
            <?php
            if(isset($_GET['view-blog'])){
                include("section/view-blog.php");

            }elseif(isset($_GET['circular-details'])){            
                include("section/view-circular.php");
                
            }elseif(isset($_GET['product-details'])){
                include("section/view-product.php");

            }elseif(isset($_GET['course-details'])){            
                include("section/view-course.php");
                include("section/feature.php");
                include("section/testimonials.php");

            }elseif(isset($_GET['testimonials'])){
                include("section/testimonials.php");            
                
            }else{
                echo "<script>window.location.href='index.php';</script>";
                exit();
            }
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>