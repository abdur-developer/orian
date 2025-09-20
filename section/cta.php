<style>        
    /* CTA Section */
    .cta-section {
        background: var(--gradient-primary);
        color: white;
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .cta-section:before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .cta-section:after {
        content: '';
        position: absolute;
        bottom: -100px;
        left: -100px;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .cta-content {
        position: relative;
        z-index: 1;
    }

    .cta-title {
        font-weight: 700;
        margin-bottom: 20px;
    }

    .cta-text {
        opacity: 0.9;
        margin-bottom: 30px;
        font-size: 1.1rem;
    }
</style>
<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8" data-aos="fade-right">
                <h2 class="cta-title">Ready to start your job preparation?</h2>
                <p class="cta-text">Enroll in your favorite course now and stay ahead in your job preparation</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-4 mt-lg-0" data-aos="fade-left">
                <a href="home.php?page=courses" class="btn btn-light btn-lg"><i class="fas fa-arrow-right me-2"></i> Browse Courses</a>
            </div>
        </div>
    </div>
</section>