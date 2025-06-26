<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Defence24BD Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/admin.css">
</head>
<body>

  <!-- Topbar -->
  <div class="topbar">
    <div style="display: flex; align-items: center;">
      <button class="menu-toggle">
        <i class="fas fa-bars"></i>
      </button>
      <div class="logo">
        <i class="fas fa-city logo-icon"></i>
        Defence24BD Admin
      </div>
    </div>
    
    <div class="topbar-right">
      <div class="notification-bell">
        <i class="fas fa-bell"></i>
        <span class="notification-badge">3</span>
      </div>
      
      <div class="user-profile">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="profile-img" alt="Profile">
        <span class="username">Abdur</span>
        <i class="fas fa-chevron-down" style="font-size: 12px;"></i>
      </div>
    </div>
  </div>

  <!-- Sidebar Overlay -->
  <div class="sidebar-overlay"></div>

  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-menu">
      <div class="menu-title">Main</div>
      <a href="#" class="menu-item active">
        <i class="fas fa-tachometer-alt menu-icon"></i>
        Dashboard
      </a>
      
      <div class="menu-title">Management</div>
      <a href="#" class="menu-item">
        <i class="fas fa-tree menu-icon"></i>
        User Management
      </a>
      <a href="#" class="menu-item">
        <i class="fas fa-concierge-bell menu-icon"></i>
        Services
      </a>
      <a href="#" class="menu-item">
        <i class="fas fa-video menu-icon"></i>
        Course
      </a>
      <a href="#" class="menu-item">
        <i class="fas fa-sitemap menu-icon"></i>
        Footer Content
      </a>
      
      <div class="menu-title">System</div>
      <!-- <a href="#" class="menu-item">
        <i class="fas fa-user-shield menu-icon"></i>
        Access Control
      </a> -->
      <a href="#" class="menu-item">
        <i class="fas fa-cog menu-icon"></i>
        Settings
      </a>
      <a href="#" class="menu-item">
        <i class="fas fa-sign-out-alt menu-icon"></i>
        Logout
      </a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="page-header">
      <h1 class="page-title">Dashboard Overview</h1>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
      </nav>
    </div>
    
    <!-- Stats Cards -->
    <div class="row">
      <div class="col-md-6 col-lg-3 fade-in" style="animation-delay: 0.1s;">
        <div class="stats-card">
          <div class="card-icon users">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-title">Total Users</div>
          <div class="card-value">1,254</div>
          <div class="card-change positive">
            <i class="fas fa-arrow-up"></i> 12.5% from last month
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-lg-3 fade-in" style="animation-delay: 0.2s;">
        <div class="stats-card">
          <div class="card-icon services">
            <i class="fas fa-concierge-bell"></i>
          </div>
          <div class="card-title">Active Services</div>
          <div class="card-value">48</div>
          <div class="card-change positive">
            <i class="fas fa-arrow-up"></i> 3 new this week
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-lg-3 fade-in" style="animation-delay: 0.3s;">
        <div class="stats-card">
          <div class="card-icon revenue">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <div class="card-title">Total Revenue</div>
          <div class="card-value">$24,560</div>
          <div class="card-change positive">
            <i class="fas fa-arrow-up"></i> 8.2% from last quarter
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-lg-3 fade-in" style="animation-delay: 0.4s;">
        <div class="stats-card">
          <div class="card-icon visitors">
            <i class="fas fa-chart-line"></i>
          </div>
          <div class="card-title">Monthly Visitors</div>
          <div class="card-value">12,458</div>
          <div class="card-change negative">
            <i class="fas fa-arrow-down"></i> 2.1% from last month
          </div>
        </div>
      </div>
    </div>
    
    <div class="row mt-4">
      <div class="col-lg-8 fade-in" style="animation-delay: 0.5s;">
        <div class="activity-card">
          <h5 class="mb-4">Recent Activities</h5>
          
          <div class="activity-item">
            <div class="activity-icon">
              <i class="fas fa-user-plus"></i>
            </div>
            <div class="activity-details">
              <div class="activity-title">New user registered</div>
              <div class="activity-desc">John Smith has created an account</div>
              <div class="activity-time">10 minutes ago</div>
            </div>
          </div>
          
          <div class="activity-item">
            <div class="activity-icon">
              <i class="fas fa-tree"></i>
            </div>
            <div class="activity-details">
              <div class="activity-title">Course added</div>
              <div class="activity-desc">New course on environmental science added</div>
              <div class="activity-time">2 hours ago</div>
            </div>
          </div>
          
          <div class="activity-item">
            <div class="activity-icon">
              <i class="fas fa-tools"></i>
            </div>
            <div class="activity-details">
              <div class="activity-title">Service request</div>
              <div class="activity-desc">New maintenance request for street lights</div>
              <div class="activity-time">5 hours ago</div>
            </div>
          </div>
          
          <div class="activity-item">
            <div class="activity-icon">
              <i class="fas fa-comment-dollar"></i>
            </div>
            <div class="activity-details">
              <div class="activity-title">Payment received</div>
              <div class="activity-desc">$250 payment for property tax</div>
              <div class="activity-time">1 day ago</div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-lg-4 fade-in" style="animation-delay: 0.6s;">
        <div class="activity-card">
          <h5 class="mb-4">Quick Actions</h5>
          
          <button class="btn btn-primary w-100 mb-3">
            <i class="fas fa-plus-circle mr-2"></i> Add New Service
          </button>
          
          <button class="btn btn-outline-primary w-100 mb-3">
            <i class="fas fa-tree mr-2"></i> Add New Course
          </button>
          
          <button class="btn btn-outline-primary w-100 mb-3">
            <i class="fas fa-user-cog mr-2"></i> Manage Users
          </button>
          
          <button class="btn btn-outline-primary w-100 mb-3">
            <i class="fas fa-chart-pie mr-2"></i> View Reports
          </button>
          
          <button class="btn btn-outline-primary w-100">
            <i class="fas fa-cog mr-2"></i> System Settings
          </button>
        </div>
      </div>
    </div>
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