<style>        
    /* Features */
    .feature-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .feature-card:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: var(--gradient-primary);
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.1);
    }

    .feature-card:hover:before {
        height: 10px;
    }

    .feature-icon {
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: var(--primary);
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        transform: scale(1.1);
        color: var(--accent);
    }

    .feature-title {
        font-weight: 600;
        margin-bottom: 15px;
        color: var(--dark);
    }

    .feature-text {
        color: #666;
        margin-bottom: 0;
    }

</style>
<!-- Features Section -->
<section class="section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Why Choose Our Platform?</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">Our special features that will give you an edge in job preparation</p>
        
        <div class="row mt-5">
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h4 class="feature-title">Experienced Instructors</h4>
                    <p class="feature-text">Learn directly from experienced instructors in both military and civilian jobs</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4 class="feature-title">Mobile Friendly</h4>
                    <p class="feature-text">Access course materials anytime from any smartphone</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 class="feature-title">24/7 Support</h4>
                    <p class="feature-text">Our expert team is always by your side for any issues</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h4 class="feature-title">Model Tests</h4>
                    <p class="feature-text">Test yourself with model exams similar to the real ones</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 class="feature-title">Progress Tracking</h4>
                    <p class="feature-text">Monitor your progress and identify your weaknesses</p>
                </div>
            </div>
            
            <!-- <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4 class="feature-title">Certificate</h4>
                    <p class="feature-text">Receive a certificate upon course completion to strengthen your CV</p>
                </div>
            </div> -->
        </div>
    </div>
</section>