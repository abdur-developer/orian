<?php $showDev = false; ?>
<?php
function code_include($name, $limit = true){
    global $conn, $showDev;
    include($name);
    include("section/comment.php");
}
require "include/dbcon.php";
code_include("section/header.php");

?>

<body>
    <?php
        code_include("section/chat.php");
        code_include("section/nav.php");
        if(isset($_GET['view-blog'])){
            code_include("section/view-blog.php");

        }elseif(isset($_GET['circular-details'])){            
            code_include("section/view-circular.php");

        }elseif(isset($_GET['about'])){            
            code_include("section/about.php");

        }elseif(isset($_GET['products'])){            
            code_include("section/products_all.php");

        }elseif(isset($_GET['course-details'])){            
            code_include("section/view-course.php");
            code_include("section/feature.php");
            code_include("section/testimonials.php");

        }elseif(isset($_GET['product-details'])){
            code_include("section/view-product.php");

        }elseif(isset($_GET['testimonials'])){
            code_include("section/testimonials.php", false);

        }else{
            code_include("section/hero.php");
            code_include("section/product.php");
            code_include("section/course.php");
            code_include("section/circular.php");
            code_include("section/cta.php");
            
            code_include("section/product.php", false);
            code_include("section/course.php", false);
            code_include("section/circular.php", false);

            code_include("section/blog.php");
        }
        code_include("section/footer.php");
    ?>
    <!-- Back to Top Button -->
    <a href="#" class="btn btn-primary back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </a>
    <?php code_include("section/script.php");?>
</body>
</html>