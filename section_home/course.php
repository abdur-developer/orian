<style>
    .card-body{
        padding: 10px 20px;
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
    }
</style>
<?php
    $id_list = [];

    $sql = "SELECT product_id FROM confirm_orders WHERE user_id = '$user_id' AND type = 'course'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { ?>
        <!-- My Courses -->
        <div class="category-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h5 fw-bold">আমার কোর্স</h2>
                <a href="#" class="text-primary text-decoration-none small"></a>
            </div>
            <div class="row g-3">
                <?php
                    while ($buy_row = $result->fetch_assoc()) {
                        $id_list[] = $buy_row['product_id'];
                        $sql = "SELECT * FROM course WHERE id = '{$buy_row['product_id']}'";
                        $course_result = $conn->query($sql);
                        if ($course_result->num_rows > 0) :
                            $row = $course_result->fetch_assoc(); ?>
                            <div class="col-md-6 col-lg-4" onclick="openCourse('<?= encryptSt($row['id']) ?>')">
                                <div class="course-card">
                                    <img src="admin/upload/<?php echo $row['img']; ?>" class="course-img" alt="Course">
                                    <div class="card-body">
                                        <h5 class="course-title"><?php echo $row['title']; ?></h5>
                                        <p class="instructor mb-2">by <?php echo $row['instructor']; ?></p>
                                        <div class="btn btn-primary w-100">লেকচার দেখুন...</div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                <?php } ?>
            </div>
        </div>
        <script>
            function openCourse(id){
                const form = document.createElement('form');
                const input = document.createElement('input');
                form.method = 'POST';
                form.action = 'video/video.php';
                input.type = 'hidden';
                input.name = 'course_id';
                input.value = id;
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        </script>
<?php } ?>
<!-- Others Courses -->
<?php
    if (!empty($id_list)) {
        $id_string = implode(',', array_map('intval', $id_list));
        $sql = "SELECT * FROM course WHERE id NOT IN ($id_string) ORDER BY rating DESC";
    } else {
        $sql = "SELECT * FROM course ORDER BY rating DESC";
    }
    $result = $conn->query($sql);
    if ($result->num_rows > 0) { ?>
        <div class="category-section">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h5 fw-bold">অন্যান্য কোর্স</h2>
                <a href="#" class="text-primary text-decoration-none small"></a>
            </div>
            <div class="row g-3">
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="col-md-6 col-lg-4" onclick="<?= ($row['status']) ? "location.href='index.php?course-details=".encryptSt($row['id'])."'" : "return null;" ?>"
                    >
                        <div class="course-card">
                            <img src="admin/upload/<?php echo $row['img']; ?>" class="course-img" alt="Course">
                            <div class="card-body">
                                <h5 class="course-title"><?php echo $row['title']; ?></h5>
                                <p class="instructor mb-2"><?php echo $row['instructor']; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price"><?= ($row['status']) ? "৳ ".$row['price'] : "Upcomming" ?></span>
                                    <span class="rating"><i class="fas fa-star"></i> <?php echo $row['rating']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
<?php } ?>