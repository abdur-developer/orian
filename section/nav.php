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
    /* Enhanced Navbar Styles */
    .navbar {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 12px 0;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .navbar.scrolled {
        padding: 8px 0;
        backdrop-filter: blur(10px);
        background-color: rgba(255, 255, 255, 0.95) !important;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand img {
        transition: all 0.3s ease;
    }

    .navbar.scrolled .navbar-brand img {
        height: 36px;
    }

    /* Animated Hamburger */
    .navbar-toggler {
        border: none;
        padding: 0.5rem;
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
        background: #333;
        transition: all 0.3s ease;
    }

    .navbar-toggler[aria-expanded="true"] .animated-hamburger span:nth-child(1) {
        transform: translateY(6px) rotate(45deg);
    }

    .navbar-toggler[aria-expanded="true"] .animated-hamburger span:nth-child(2) {
        opacity: 0;
    }

    .navbar-toggler[aria-expanded="true"] .animated-hamburger span:nth-child(3) {
        transform: translateY(-6px) rotate(-45deg);
    }

    /* Nav Links Enhancement */
    .nav-item {
        position: relative;
    }

    .nav-link {
        color: #333;
        font-weight: 500;
        padding: 0.5rem 0;
        margin: 0 0.5rem;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .nav-icon-wrapper {
        display: flex;
        align-items: center;
    }

    .nav-highlight {
        display: block;
        width: 0;
        height: 2px;
        background: var(--primary);
        transition: width 0.3s ease, background-color 0.3s ease;
        margin-top: 4px;
    }

    .nav-link:hover .nav-highlight,
    .nav-link.active .nav-highlight {
        width: 100%;
    }

    .nav-link.active {
        color: var(--primary);
        font-weight: 600;
    }

    /* Login Button Enhancement */
    .login-btn {
        border-radius: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 10px rgba(78, 115, 223, 0.3);
        position: relative;
        overflow: hidden;
    }

    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(78, 115, 223, 0.4);
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
        
        .nav-link {
            padding: 0.75rem 0;
            margin: 0;
        }
        
        .login-btn {
            margin-top: 1rem;
            width: 100%;
        }
    }

</style>
<!-- Enhanced Header -->
<header>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="/bn">
                <img src="img/logo.jpg" alt="Abdur" class="logo img-fluid" style="height: 40px; transition: all 0.3s ease;">
                Defence 24 bd
            </a>
            
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <div class="animated-hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" href="/bn">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-home me-2"></i>
                                <span>হোম</span>
                            </div>
                            <span class="nav-highlight"></span>
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/bn/circular">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-bullhorn me-2"></i>
                                <span>সার্কুলার</span>
                            </div>
                            <span class="nav-highlight"></span>
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/bn/all-courses">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-book me-2"></i>
                                <span>সকল কোর্স</span>
                            </div>
                            <span class="nav-highlight"></span>
                        </a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="/bn/model-test">
                            <div class="nav-icon-wrapper">
                                <i class="fas fa-clipboard-list me-2"></i>
                                <span>মডেল টেস্ট</span>
                            </div>
                            <span class="nav-highlight"></span>
                        </a>
                    </li>
                </ul>
                
                <a href="/bn/login" class="btn btn-primary ms-lg-3 mt-3 mt-lg-0 px-3 py-2 login-btn">
                    <i class="fas fa-sign-in-alt me-2"></i> লগইন
                </a>
            </div>
        </div>
    </nav>
</header>