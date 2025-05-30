<style>
    /* Floating Elements */
    .floating {
        position: absolute;
        animation: floating 6s ease-in-out infinite;
        z-index: 0;
        opacity: 0.1;
    }

    @keyframes floating {
        0% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
        100% { transform: translateY(0px) rotate(0deg); }
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.2rem;
        }
        
        .section {
            padding: 60px 0;
        }
        
        .stat-item:not(:last-child):after {
            display: none;
        }
    }
</style>
<!-- Floating Background Elements -->
<div class="floating" style="top: 10%; left: 5%; font-size: 5rem; color: var(--primary);">
    <i class="fas fa-circle"></i>
</div>
<div class="floating" style="top: 70%; left: 80%; font-size: 8rem; color: var(--accent);">
    <i class="fas fa-square"></i>
</div>
<div class="floating" style="top: 30%; left: 75%; font-size: 4rem; color: var(--primary);">
    <i class="fas fa-triangle"></i>
</div>
<style>
    :root {
        --primary: #4e73df;
        --primary-dark: #2e59d9;
    }

    /* Enhanced Navbar Styles with Gradient */
    .navbar {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 12px 0;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .navbar.scrolled {
        padding: 8px 0;
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.98) !important;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        font-weight: 700;
        color: #2c3e50;
    }

    .navbar-brand img {
        transition: all 0.3s ease;
        margin-right: 10px;
        border-radius: 4px;
    }

    .navbar.scrolled .navbar-brand img {
        height: 36px;
    }

    /* Fixed Mobile Toggle Button */
    .navbar-toggler {
        border: none;
        padding: 0.5rem;
        outline: none !important;
        display: block; /* Ensure it's always visible */
    }

    .animated-hamburger {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 20px;
        width: 24px;
        cursor: pointer;
    }

    .animated-hamburger span {
        display: block;
        height: 2px;
        width: 100%;
        background: var(--primary);
        transition: all 0.3s ease;
        transform-origin: center;
    }

    .navbar-toggler[aria-expanded="true"] .animated-hamburger span:nth-child(1) {
        transform: translateY(6px) rotate(45deg);
        background: var(--primary-dark);
    }

    .navbar-toggler[aria-expanded="true"] .animated-hamburger span:nth-child(2) {
        opacity: 0;
        transform: scaleX(0);
    }

    .navbar-toggler[aria-expanded="true"] .animated-hamburger span:nth-child(3) {
        transform: translateY(-6px) rotate(-45deg);
        background: var(--primary-dark);
    }

    /* Nav Links with Creative Effects */
    .nav-item {
        position: relative;
        margin: 0 0.25rem;
    }

    .nav-link {
        color: #2c3e50;
        font-weight: 500;
        padding: 0.5rem 0.75rem;
        margin: 0 0.25rem;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 6px;
    }

    .nav-icon-wrapper {
        display: flex;
        align-items: center;
        position: relative;
    }

    .nav-highlight {
        display: block;
        width: 0;
        height: 2px;
        background: var(--primary);
        transition: width 0.3s ease, background-color 0.3s ease;
        margin-top: 4px;
    }

    .nav-link:hover {
        background: rgba(78, 115, 223, 0.05);
        color: var(--primary);
    }

    .nav-link:hover .nav-highlight,
    .nav-link.active .nav-highlight {
        width: 100%;
    }

    .nav-link.active {
        color: var(--primary);
        font-weight: 600;
        background: rgba(78, 115, 223, 0.08);
    }

    /* Fixed Login Button Styles */
    .login-btn {
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(78, 115, 223, 0.3);
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border: none;
        font-weight: 500;
        color: white !important;
        display: inline-flex !important; /* Ensure it's always visible */
        align-items: center;
        justify-content: center;
        text-decoration: none !important;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(78, 115, 223, 0.4);
        color: white;
    }

    .login-btn:active {
        transform: translateY(0);
    }

    .login-btn::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: 0.5s;
    }

    .login-btn:hover::after {
        left: 100%;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .navbar-collapse {
            padding: 1rem;
            background: white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 0 0 10px 10px;
            margin-top: 10px;
        }
        
        .nav-item {
            margin: 0.25rem 0;
        }
        
        .nav-link {
            padding: 0.75rem 1rem;
            margin: 0;
            justify-content: flex-start;
        }
        
        .login-btn {
            margin-top: 1rem;
            width: 100%;
            max-width: 200px;
            margin-left: auto;
            margin-right: auto;
        }
    }

    /* Animation for Logo */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    .navbar-brand:hover img {
        animation: pulse 1s ease;
    }
</style>

<!-- Fixed Header with Visible Elements -->
<header>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.jpg" alt="Defence 24 bd" class="logo img-fluid" style="height: 40px;">
                Defence 24 bd
            </a>
            
            <!-- Fixed Mobile Toggle Button -->
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <div class="animated-hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link <?php if(!isset($_GET)) echo "active"; ?>" href="index.php">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-home me-2"></i>
                                <span>হোম</span>
                            </div>
                            <span class="nav-highlight"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($_GET['circular'])) echo "active"; ?>" href="?circular">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-bullhorn me-2"></i>
                                <span>সার্কুলার</span>
                            </div>
                            <span class="nav-highlight"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?courses">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-book me-2"></i>
                                <span>সকল কোর্স</span>
                            </div>
                            <span class="nav-highlight"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?model-test">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-clipboard-list me-2"></i>
                                <span>মডেল টেস্ট</span>
                            </div>
                            <span class="nav-highlight"></span>
                        </a>
                    </li>
                </ul>
                
                <!-- Fixed Login Button -->
                <div class="d-flex ms-lg-3 mt-3 mt-lg-0">
                    <?php if (!isset($_SESSION['number']) || !isset($_SESSION['web'])): ?>
                        <a href="auth.php" class="btn login-btn px-4 py-2">
                            <i class="fas fa-sign-in-alt me-2"></i> লগইন
                        </a>
                    <?php else: ?>
                        <a href="home.php" class="btn login-btn px-4 py-2">
                            <i class="fas fa-tachometer-alt me-2"></i> ড্যাশবোর্ড
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    // Add scroll effect to navbar
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
    
    // Close mobile menu when clicking a link
    const navLinks = document.querySelectorAll('.nav-link');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth < 992) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                    toggle: false
                });
                bsCollapse.hide();
            }
        });
    });
</script>