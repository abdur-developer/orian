<?php
require "include/dbcon.php";
include("section/header.php");
?>
<body>
    <?php
        include("section/nav.php");
        if(isset($_GET['view-blog'])){
            include("section/view-blog.php");
        }elseif(isset($_GET['course-details'])){
            include("section/view-course.php");
        }elseif(isset($_GET['product-details'])){
            include("section/view-product.php");
        }else{
            include("section/hero.php");
            include("section/feature.php");
            include("section/course.php");
            include("section/product.php");
            include("section/testimonials.php");
            include("section/blog.php");
            include("section/cta.php");
        }
        include("section/footer.php");
    ?>
    <!-- Back to Top Button -->
    <a href="#" class="btn btn-primary back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>
    <?php include("section/script.php");?>
</body>
</html>