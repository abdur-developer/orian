<style>
    :root {
      --primary: #4361ee;
      --primary-light: #e6ebff;
      --text: #2b2d42;
      --text-light: #8d99ae;
      --bg: #f8f9fa;
      --card-bg: #ffffff;
      --border: #e9ecef;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    body {
      background-color: var(--bg);
      color: var(--text);
      min-height: 100vh;
    }
    
    /* Dashboard Layout */
    .dashboard {
      display: flex;
      flex-direction: column;
    }
    
    /* Sidebar - Mobile First */
    .sidebar {
      width: 100%;
      background: var(--card-bg);
      padding: 1.5rem;
      border-bottom: 1px solid var(--border);
    }
    
    .profile-card {
      display: flex;
      align-items: center;
      gap: 1rem;
      margin-bottom: 1.5rem;
    }
    
    .avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid var(--primary-light);
    }
    
    .profile-info h2 {
      font-size: 1.1rem;
      margin-bottom: 0.2rem;
    }
    
    .profile-info p {
      color: var(--text-light);
      font-size: 0.8rem;
    }
    
    .sidebar-nav {
      display: flex;
      overflow-x: auto;
      padding-bottom: 0.5rem;
      gap: 0.5rem;
    }
    
    .sidebar-nav a {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.5rem 0.75rem;
      text-decoration: none;
      color: var(--text);
      border-radius: 20px;
      white-space: nowrap;
      font-size: 0.9rem;
      background-color: var(--bg);
      transition: all 0.2s;
    }
    
    .sidebar-nav a:hover {
      background-color: var(--primary-light);
      color: var(--primary);
    }
    
    .sidebar-nav a.active {
      background-color: var(--primary);
      color: white;
    }
    
    /* Main Content */
    .content {
      padding: 1.5rem;
    }
    
    .content-header h1 {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 1.5rem;
    }
    
    .profile-form {
      background: var(--card-bg);
      padding: 1.5rem;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .form-group {
      display: flex;
      flex-direction: column;
      gap: 1rem;
      margin-bottom: 1rem;
    }
    
    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      font-size: 0.9rem;
    }
    
    .form-input {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 0.95rem;
      transition: border 0.2s;
    }
    
    .form-input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px var(--primary-light);
    }
    
    .form-input:disabled {
      background-color: #f5f5f5;
      color: #666;
    }
    
    textarea.form-input {
      min-height: 100px;
      resize: vertical;
    }
    
    .bio-label {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 0.5rem;
    }
    
    .bio-label span {
      font-size: 0.8rem;
      color: var(--text-light);
    }
    
    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 1rem;
      margin-top: 1.5rem;
    }
    
    .btn {
      padding: 0.75rem 1.25rem;
      border-radius: 8px;
      font-weight: 500;
      cursor: pointer;
      border: none;
      transition: all 0.2s;
      font-size: 0.9rem;
    }
    
    .btn-primary {
      background-color: var(--primary);
      color: white;
    }
    
    .btn-primary:hover {
      background-color: #3a56d4;
    }
    
    .btn-secondary {
      background-color: var(--card-bg);
      color: var(--text);
      border: 1px solid var(--border);
    }
    
    .btn-secondary:hover {
      background-color: #f1f3f9;
    }
    
    /* Tablet and larger screens */
    @media (min-width: 768px) {
      .dashboard {
        flex-direction: row;
        min-height: 100vh;
      }
      
      .sidebar {
        width: 280px;
        border-right: 1px solid var(--border);
        border-bottom: none;
        padding: 2rem 1.5rem;
      }
      
      .profile-card {
        flex-direction: column;
        text-align: center;
        gap: 0;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border);
      }
      
      .avatar {
        width: 100px;
        height: 100px;
        margin-bottom: 1rem;
      }
      
      .profile-info h2 {
        font-size: 1.25rem;
      }
      
      .sidebar-nav {
        flex-direction: column;
        overflow-x: visible;
        padding-bottom: 0;
        gap: 0.5rem;
      }
      
      .sidebar-nav a {
        border-radius: 8px;
        padding: 0.75rem 1rem;
      }
      
      .content {
        flex: 1;
        padding: 2.5rem;
      }
      
      .form-group {
        flex-direction: row;
        gap: 1.5rem;
      }
      
      .form-group > div {
        flex: 1;
      }
    }
    
    /* Large desktop screens */
    @media (min-width: 1200px) {
      .sidebar {
        width: 300px;
      }
      
      .content {
        padding: 3rem;
      }
    }
</style>
<div class="dashboard">
    <div class="sidebar">
      <div class="profile-card">
        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile Image" class="avatar">
        <div class="profile-info">
          <h2><?= $user['name'] ?></h2>
          <?php if($user['student_id']): ?>
          <p>Student ID #<?= $user['student_id'] ?></p>
          <?php endif; ?>
        </div>
      </div>
      
      <nav class="sidebar-nav">
        <a href="#"><span>🏷️</span> My Courses</a>
        <a href="#"><span>❤️</span> My Wishlist</a>
        <a href="#"><span>🔄</span> Purchase History</a>
        <a href="#" class="active"><span>👤</span> My Profile</a>
      </nav>
    </div>
    
    <div class="content">
      <div class="content-header">
        <h1>Personal Information</h1>
      </div>
      
      <form class="profile-form">
        <div class="form-group">
          <div>
            <label class="form-label">First Name</label>
            <input type="text" class="form-input" value="<?= $user['name'] ?>" disabled>
          </div>
        </div>
        
        <div class="form-group">
          <div>
            <label class="form-label">Email</label>
            <input type="email" class="form-input" value="<?= $user['email'] ?>" disabled>
          </div>
          <div>
            <label class="form-label">Mobile</label>
            <input type="tel" class="form-input" value="<?= $user['number'] ?>" disabled>
          </div>
        </div>
        
        <div>
          <label class="form-label">Address</label>
          <textarea class="form-input" placeholder="Enter your address"></textarea>
        </div>
        
        <div>
          <div class="bio-label">
            <label class="form-label">Author Bio</label>
            <span>Max. 500 characters</span>
          </div>
          <textarea class="form-input" placeholder="Write something about yourself..."></textarea>
        </div>
        
        <div class="form-actions">
          <button type="button" class="btn btn-secondary">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
    </div>
</div>