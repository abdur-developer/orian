<style>
    /* Modern Slider & Category Section */
    .hero-section {        
        background-color: #fff;
        position: relative;
        padding: 100px 0;
        color: black;
        overflow: hidden;
    }

    /* Modern Carousel */
    .modern-carousel {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        margin-bottom: 2.5rem;
    }
    
    .modern-carousel .carousel-inner {
        border-radius: 16px;
        overflow: hidden;
    }
    
    .modern-carousel img {
        height: 300px;
        object-fit: cover;
        object-position: center;
        filter: brightness(0.95);
        transition: transform 0.5s ease;
    }
    
    .modern-carousel .carousel-item:hover img {
        transform: scale(1.03);
    }
    
    .modern-carousel .carousel-indicators {
        bottom: 20px;
    }
    
    .modern-carousel .carousel-indicators [data-bs-target] {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: rgba(255,255,255,0.5);
        border: 2px solid transparent;
        transition: all 0.3s ease;
        margin: 0 6px;
    }
    
    .modern-carousel .carousel-indicators .active {
        background-color: #fff;
        transform: scale(1.2);
        border-color: #2563eb;
    }
    
    /* Category Section */
    .category-section {
        position: relative;
    }
    
    .category-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .category-title h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        position: relative;
        padding-left: 15px;
    }
    
    .category-title h2:before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 20px;
        background: #2563eb;
        border-radius: 3px;
    }
    
    .category-title .view-all {
        color: #2563eb;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .category-title .view-all:hover {
        color: #1d4ed8;
        transform: translateX(5px);
    }
    
    .category-title .view-all i {
        margin-left: 5px;
        transition: all 0.3s ease;
    }
    
    .category-title .view-all:hover i {
        transform: translateX(3px);
    }
    
    .category-scroll {
        display: flex;
        overflow-x: auto;
        padding-bottom: 1rem;
        scrollbar-width: none; /* Firefox */
    }
    
    .category-scroll::-webkit-scrollbar {
        display: none; /* Chrome/Safari */
    }
    
    .category-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 90px;
        margin-right: 1.5rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .category-item:last-child {
        margin-right: 0;
    }
    
    .category-icon {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        margin-bottom: 12px;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .category-icon img {
        width: 40px;
        height: 40px;
        object-fit: contain;
        transition: all 0.3s ease;
    }
    
    .category-icon:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: #2563eb;
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s ease;
    }
    
    .category-item:hover .category-icon {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.15);
    }
    
    .category-item:hover .category-icon:after {
        transform: scaleX(1);
        transform-origin: left;
    }
    
    .category-item:hover .category-icon img {
        transform: scale(1.1);
    }
    
    .category-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: #334155;
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .category-item:hover .category-name {
        color: #2563eb;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .modern-carousel img {
            height: 220px;
        }
        
        .category-item {
            min-width: 80px;
            margin-right: 1rem;
        }
        
        .category-icon {
            width: 60px;
            height: 60px;
        }
        
        .category-icon img {
            width: 35px;
            height: 35px;
        }
    }
</style>

<!-- Modern Slider & Category Section -->
<section class="hero-section">
    <div class="container">
        <!-- Modern Carousel -->
        <div id="modernCarousel" class="carousel slide modern-carousel" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" class="d-block w-100" alt="Learning Community">
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="d-block w-100" alt="Online Education">
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" class="d-block w-100" alt="Graduation Celebration">
                </div>
            </div>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#modernCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#modernCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#modernCarousel" data-bs-slide-to="2"></button>
            </div>
        </div>

        <!-- Modern Category Section -->
        <div class="category-section">
            <div class="category-title">
                <h2>Browse Categories</h2>
                <a href="#" class="view-all">View All <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="category-scroll">
                <a href="#" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/2936/2936886.png" alt="Programming">
                    </div>
                    <span class="category-name">Programming</span>
                </a>
                
                <a href="#" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/2933/2933245.png" alt="Design">
                    </div>
                    <span class="category-name">Design</span>
                </a>
                
                <a href="#" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/2933/2933293.png" alt="Marketing">
                    </div>
                    <span class="category-name">Marketing</span>
                </a>
                
                <a href="#" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/2936/2936777.png" alt="Business">
                    </div>
                    <span class="category-name">Business</span>
                </a>
                
                <a href="#" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/2933/2933323.png" alt="Photography">
                    </div>
                    <span class="category-name">Photography</span>
                </a>
                
                <a href="#" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/2936/2936704.png" alt="Music">
                    </div>
                    <span class="category-name">Music</span>
                </a>
                
                <a href="#" class="category-item">
                    <div class="category-icon">
                        <img src="https://cdn-icons-png.flaticon.com/512/2933/2933451.png" alt="Health">
                    </div>
                    <span class="category-name">Health</span>
                </a>
            </div>
        </div>
    </div>
</section>