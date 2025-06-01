<?php
    if(!isset($_POST['course_id']) || empty($_POST['course_id'])) {
        header("Location: ../index.php");
        exit();
    }
    require '../include/dbcon.php';
    $course_id = decryptSt($_POST['course_id']);
    $stmt = $conn->prepare("SELECT * FROM `course` WHERE `id` = ?");
    $stmt->bind_param("i", $course_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows <= 0) {
        header("Location: ../index.php");
        exit();
    }
    $course = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ফ্রী কোর্স ভিডিও | <?= htmlspecialchars($course['title'], ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/video.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="../img/logo.jpg" alt="Logo" class="logo-img">
                <span class="logo-text">আব্দুর রহমান</span>
            </div>
            <div class="auth-status">
                <div class="user-avatar">AR</div>
            </div>
        </header>
        
        <div class="player-container">
            <div class="main-player">
                <div class="video-wrapper">
                    
                    <video id="main-video" class="main-video" controls controlsList="nodownload noremoteplayback" disablePictureInPicture>
                        <source src="" type="video/mp4">
                        আপনার ব্রাউজার ভিডিও ট্যাগ সাপোর্ট করে না।
                    </video>
                    <div class="video-controls-overlay" id="password-overlay">
                        <h3>ছোট্ট একটি প্রশ্ন করি...</h3>
                        <p>বল তো <span id="firstNumber">5</span>+<span id="secondNumber">3</span> = কত হবে..?</p>
                        <input type="number" class="password-input" placeholder="উত্তর লিখুন" id="video-password">
                        <input type="hidden" id="video-name" value="mashup.mp4">
                        <button class="verify-btn" onclick="verifyPassword()">যাচাই করুন</button>
                    </div>
                </div>
                <div class="video-info">
                    <!-- <h1 class="course-title">ডাটা সায়েন্স এন্ড মেশিন লার্নিং</h1> -->
                    <div class="module-title">
                        <i class="fas fa-folder-open"></i>
                        <span id="module-title">মডিউল ১: ভূমিকা ও বেসিক কনসেপ্ট</span>
                    </div>
                    <p class="video-description" id="video-description">
                        প্লেলিস্ট থেকে আপনার কাঙ্ক্ষিত ভিডিও লেকচারটি নির্বাচন করুন। প্রতিটি ভিডিওতে কোর্সের গুরুত্বপূর্ণ বিষয়বস্তু বিস্তারিতভাবে আলোচনা করা হয়েছে।
                    </p>
                    
                    <!-- <div class="progress-container">
                        <div class="progress-label">
                            <span>কোর্স সম্পূর্ণতা</span>
                            <span>৩৫% সম্পূর্ণ</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill"></div>
                        </div>
                    </div> -->
                </div>
            </div>

            <div class="playlist">
                <div class="playlist-header">
                    <span class="playlist-title">কোর্স কন্টেন্ট</span>
                    <!-- <span class="playlist-count">১২ টি</span> -->
                </div>
                <script>
                    function firstPlayVideo(moduleTitle, videoSrc, description) {
                        document.getElementById('video-name').value = videoSrc;
                        document.getElementById('module-title').textContent = moduleTitle;
                        document.getElementById('video-description').textContent = description;
                    }
                </script>
                <div class="playlist-scroll">
                    <?php
                    $sql = "SELECT * FROM course_module WHERE course_id = '$course_id'";
                    $result_module = mysqli_query($conn, $sql);
                    $module_count = 0;
                    $details_count = 0;
                    while ($course_module = mysqli_fetch_assoc($result_module)) {
                        ++$module_count;
                        $module_title = "Module {$module_count}: " . htmlspecialchars($course_module['title'], ENT_QUOTES, 'UTF-8');
                        ?>
                        <div class="module-group">
                            <div class="module-header">
                                <span><?= $module_title ?></span>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="module-content">
                                <?php
                                    $sql = "SELECT * FROM `module_details` WHERE module_id = '{$course_module['id']}'";
                                    $result = mysqli_query($conn, $sql);
                                    while ($module_details = mysqli_fetch_assoc($result)) {
                                        if($details_count == 0) {
                                            if($module_details['is_free'] == '1') {
                                                echo "<script>firstPlayVideo('{$module_title}', '{$module_details['video']}', '{$module_details['title']}')</script>";
                                                ++$details_count;
                                            }
                                        }
                                ?>
                                <div class="playlist-item <?php echo $details_count == 1 ? 'active' : ''; $details_count++ ?>" onclick="playVideo(this, '<?= $module_title ?>')"
                                    data-video="<?= $module_details['is_free'] == '1' ? $module_details['video'] : 'paid.mp4' ?>"
                                    data-title="<?= $module_details['title'] ?>"
                                    >
                                    <div class="playlist-item-number"><?= $details_count; ?></div>
                                    <div class="playlist-item-info">
                                        <div class="playlist-item-title"><?= $module_details['title'] ?></div>
                                        <div class="playlist-item-duration">
                                            <i class="far fa-clock"></i> <?= $module_details['time'] ?>
                                        </div>
                                    </div>
                                    <div class="playlist-item-lock">
                                        <i class="fas <?=$module_details['is_free'] == '1' ? 'fa-check-circle' : 'fa-lock' ?>"></i>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    
                    <div class="security-notice">
                        <i class="fas fa-shield-alt"></i>
                        <span>এই কোর্সের সমস্ত কন্টেন্ট সুরক্ষিত। অননুমোদিত শেয়ারিং বা ডাউনলোড কপিরাইট আইনে শাস্তিযোগ্য অপরাধ।</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>