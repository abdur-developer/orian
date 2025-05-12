<style>
    /* Hero Section */
    .hero {
        background-color: #fff;
        position: relative;
        padding: 150px 0 100px;
        color: black;
        overflow: hidden;
    }
    /* 
    .hero:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.7);
        z-index: 0;
    } */

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .tagline {
        color: var(--accent);
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 15px;
        display: inline-block;
        position: relative;
        padding-left: 50px;
    }

    .tagline:before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 3px;
        background: var(--accent);
    }

    .hero-title {
        font-weight: 700;
        font-size: 3rem;
        margin-bottom: 20px;
        line-height: 1.2;
        text-shadow: 0 2px 5px rgba(0,0,0,0.3);
    }

    .hero-description {
        font-size: 1.1rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .hero-image {
        position: relative;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }

    /* Stats */
    .stats {
        background: rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 20px;
        margin-top: 40px;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
        position: relative;
    }

    .stat-item:not(:last-child):after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 1px;
        height: 50px;
        background: rgba(0,0,0,0.2);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: black;
    }

    .stat-label {
        font-size: 0.9rem;
        opacity: 0.8;
    }

</style>
<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <p class="tagline">Abdur LTD</p>
                <h1 class="hero-title animate__animated animate__fadeInDown">সকল চাকুরীর প্রস্তুতি নিন ঘরে বসে</h1>
                <p class="hero-description animate__animated animate__fadeIn animate__delay-1s">
                    সেরা প্রশিক্ষকদের থেকে ঘরে বসেই পেতে পারেন কাঙ্খিত দক্ষতা অর্জনের সুযোগ। 
                    আমাদের কোর্স এর সাহায্যে যেকোনো সময় আপনি চাকরি সংক্রান্ত সকল প্রয়োজনীয় 
                    প্রস্তুতি নিতে পারবেন শুধুমাত্র একটি স্মার্টফোনের মাধ্যমে।
                </p>
                <div class="hero-actions animate__animated animate__fadeInUp animate__delay-1s">
                    <a href="/bn/all-courses" class="btn btn-primary me-3"><i class="fas fa-book-open me-1"></i> সকল কোর্স</a>
                    <a href="#" class="btn btn-outline"><i class="fas fa-hand-holding-usd me-1"></i> আর্ন বাই রেফারেল</a>
                </div>
                
                <div class="stats animate__animated animate__fadeIn animate__delay-2s">
                    <div class="row">
                        <div class="col-4">
                            <div class="stat-item">
                                <div class="stat-number">500+</div>
                                <div class="stat-label">কোর্স</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-item">
                                <div class="stat-number">50K+</div>
                                <div class="stat-label">শিক্ষার্থী</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-item">
                                <div class="stat-number">95%</div>
                                <div class="stat-label">সাফল্যের হার</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="hero-image text-center">
                    <img src="img/app.jpg" 
                            alt="Online Learning" class="img-fluid" style="max-height: 500px;">
                </div>
            </div>
        </div>
    </div>
</section>