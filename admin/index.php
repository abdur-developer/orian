<?php require_once 'admin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Secure Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/admin.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../js/admin.js"></script>
</head>
<body>
  <?php
    if (isset($_GET['error'])) {
        $error_message = htmlspecialchars($_GET['error']);
        echo "<script>toast('$error_message', 'error');</script>";
    }
    if (isset($_GET['success'])) {
        $success_message = htmlspecialchars($_GET['success']);
        echo "<script>toast('$success_message');</script>";
    }
  ?>
  <!-- Topbar -->
  <div class="topbar">
    <div style="display: flex; align-items: center;">
      <button class="menu-toggle">
        <i class="fas fa-bars"></i>
      </button>
      <div class="logo">
        <i class="fas fa-city logo-icon"></i>
        ProtiSheba
      </div>
    </div>
    
    <div class="topbar-right">
      <!-- <div class="notification-bell">
        <i class="fas fa-bell"></i>
        <span class="notification-badge">3</span>
      </div> -->
      
      <div class="user-profile">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="profile-img" alt="Profile">
        <span class="username">Admin</span>
        <i class="fas fa-chevron-down" style="font-size: 12px;"></i>
      </div>
    </div>
  </div>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay"></div>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-menu">
      <?php
        //h=>href, i=>icon class, t=>title
        $menus = [
          // 'Main' => [
          //   ['h' => '?q=dashboard', 'i' => 'tachometer-alt', 't' => 'Dashboard']
          // ],
          'Management' => [
            //['h' => '?q=cart', 'i' => 'shopping-cart', 't' => 'Cart'],
            //['h' => '?q=category', 'i' => 'th-list', 't' => 'Category'],
            ['h' => '?q=chat_suggestions', 'i' => 'comments', 't' => 'Chat Suggestions'],
            ['h' => '?q=circulars', 'i' => 'newspaper', 't' => 'Circulars'],
            ['h' => '?q=confirm_orders', 'i' => 'check-circle', 't' => 'Confirm Orders'],
            ['h' => '?q=consultant', 'i' => 'user-tie', 't' => 'Consultant'],
            ['h' => '?q=coupons', 'i' => 'tags', 't' => 'Coupons'],
            ['h' => '?q=course', 'i' => 'video', 't' => 'Course'],
            //['h' => '?q=course_module', 'i' => 'puzzle-piece', 't' => 'Course Module'],
            ['h' => '?q=job_apply', 'i' => 'briefcase', 't' => 'Job Apply'],
            ['h' => 'chat.php', 'i' => 'envelope', 't' => 'Messages'],
            //['h' => '?q=module_details', 'i' => 'cubes', 't' => 'Module Details'],
            //['h' => '?q=orders', 'i' => 'box', 't' => 'Orders'],
            ['h' => '?q=post', 'i' => 'thumbtack', 't' => 'Post'],
            ['h' => '?q=product', 'i' => 'box-open', 't' => 'Product'],
            ['h' => '?q=questions', 'i' => 'question-circle', 't' => 'Questions'],
            //['h' => '?q=slider', 'i' => 'image', 't' => 'Slider'],
            //['h' => '?q=system_structure', 'i' => 'project-diagram', 't' => 'System Structure'],
            ['h' => '?q=testimonials', 'i' => 'comment-dots', 't' => 'Testimonials'],
            ['h' => '?q=users', 'i' => 'users', 't' => 'Users']
          ],
          'System' => [
            // ['h' => '?q=access_control', 'i' => 'user-shield', 't' => 'Access Control'],
            ['h' => '?q=settings', 'i' => 'cog', 't' => 'Settings'],
            ['h' => 'logout.php', 'i' => 'sign-out-alt', 't' => 'Logout']
          ]
        ];

        $active = $_GET['q'] ?? 'dashboard';

        foreach ($menus as $section => $items) {
          echo "<div class='menu-title'>$section</div>";
          foreach ($items as $item) {
            $isActive = ($active === ltrim(strstr($item['h'], '='), '=')) ? 'active' : '';
            echo "<a href='{$item['h']}' class='menu-item $isActive'><i class='fas fa-{$item['i']} menu-icon'></i>{$item['t']}</a>";
          }
        }
      ?>
    </div>
  </div>




  <!-- Main Content -->
  <div class="main-content">
<!-- ======================================== -->

  <?php
    $q = $_REQUEST['q'] ?? ''; // page value
    $e = $_REQUEST['e'] ?? ''; // edit view value

    $allowed_q = [
      "dashboard", "cart", "category", "chat_suggestions", "circulars",
      "confirm_orders", "consultant", "coupons", "course", "course_module",
      "job_apply", "messages", "module_details", "orders", "post",
      "product", "questions", "system_structure", "testimonials",
      "users", "settings", "slider", "edit_notice", "course_module",
      "module_details"
    ];
    $allowed_e = [
      "circulars", "post", "product", "questions", "testimonials",
      "course", "course_module", "module_details", "job_apply",
      "users", "confirm_orders"
    ];

    if ($q && in_array($q, $allowed_q)) include "sec/{$q}.php";
    elseif($e && in_array($e, $allowed_e)) include "view/{$e}.php";
    else include "sec/users.php";
    // else include "sec/dashboard.php";
    
  ?>




<!-- ======================================== -->
    
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Toggle sidebar on mobile
    document.querySelector('.menu-toggle').addEventListener('click', function() {
      document.querySelector('.sidebar').classList.toggle('active');
      document.querySelector('.sidebar-overlay').classList.toggle('active');
    });
    
    // Close sidebar when clicking on overlay
    document.querySelector('.sidebar-overlay').addEventListener('click', function() {
      document.querySelector('.sidebar').classList.remove('active');
      this.classList.remove('active');
    });
    
    // Add active class to clicked menu item and close sidebar on mobile
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
      item.addEventListener('click', function() {
        menuItems.forEach(i => i.classList.remove('active'));
        this.classList.add('active');
        
        // Close sidebar on mobile after clicking a menu item
        if (window.innerWidth < 992) {
          document.querySelector('.sidebar').classList.remove('active');
          document.querySelector('.sidebar-overlay').classList.remove('active');
        }
      });
    });
    
    // Handle window resize
    function handleResize() {
      if (window.innerWidth >= 992) {
        document.querySelector('.sidebar').classList.remove('active');
        document.querySelector('.sidebar-overlay').classList.remove('active');
      }
    }
    
    window.addEventListener('resize', handleResize);
  </script>
</body>
</html>