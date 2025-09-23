<!-- Bottom Navigation -->
<style>
    .bottom-nav {
        position: fixed;
        bottom: 0;
        width: 100%;
        background: white;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
        z-index: 1000;
        padding: 10px 0;
    }
    
    .nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
        color: var(--light-text);
    }
    
    .nav-icon {
        font-size: 1.2rem;
    }
    
    .nav-text {
        font-size: 11px;
        margin-top: 3px;
    }
    
    .nav-item.active {
        color: orange;
    }
    
    /* Responsive Adjustments */
    @media (min-width: 768px) {            
        .nav-icon {
            font-size: 1.5rem;
        }            
        .nav-text {
            font-size: 12px;
        }
    }
</style>
<nav class="bottom-nav">
    <div class="container">
        <div class="row">
            <div class="col">
                <a href="index.php" class="nav-item active">
                    <i class="fas fa-home nav-icon"></i>
                    <span class="nav-text">For you</span>
                </a>
            </div>
            <div class="col">
                <a href="home.php?page=consultants" class="nav-item">
                    <i class="fas fa-comments nav-icon"></i>
                    <span class="nav-text">Messages</span>
                </a>
            </div>
            <div class="col">
                <a href="index.php" class="nav-item">
                    <img src="img/logo.jpg" width="40" height="40">
                </a>
            </div>
            <div class="col">
                <a href="cart/" class="nav-item">
                    <i class="fas fa-shopping-bag nav-icon"></i>
                    <span class="nav-text">cart</span>
                </a>
            </div>
            <div class="col">
                <a href="home.php?page=profile" class="nav-item">
                    <i class="fas fa-user nav-icon"></i>
                    <span class="nav-text">Account</span>
                </a>
            </div>
        </div>
    </div>
</nav>