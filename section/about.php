<?php $showDev = true; ?>

<style>
    :root {
        --primary: #4361ee;
        --secondary: #3f37c9;
        --accent: #4cc9f0;
        --light: #f8f9fa;
        --dark: #212529;
        --gold: #ffd700;
        --success: #4bb543;
        --text-color: #555;
    }

    body {
        font-family: 'Hind Siliguri', sans-serif;
        color: var(--text-color);
        background: #fff;
    }

    /* About Section */
    .section {
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .container {
        position: relative;
        z-index: 1;
    }

    .main-section-title {
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 15px;
        color: var(--primary);
        position: relative;
        padding-bottom: 15px;
    }

    .main-section-title::after {
        content: '';
        position: absolute;
        bottom: 0; left: 50%;
        transform: translateX(-50%);
        width: 80px; height: 4px;
        background: linear-gradient(to right, var(--primary), var(--secondary));
        border-radius: 2px;
    }

    .section-subtitle {
        text-align: center;
        font-size: 1.2rem;
        color: var(--text-color);
        margin-bottom: 60px;
        max-width: 700px;
        margin: 0 auto 60px auto;
    }

    .about-card {
        background: #fff;
        border-radius: 16px;
        padding: 30px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        border-left: 4px solid var(--primary);
        transition: all 0.4s ease;
        height: 100%;
    }

    .about-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.12);
    }

    .card-icon {
        font-size: 2.5rem;
        margin-bottom: 15px;
        display: inline-block;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
<?php
    $sql = "SELECT * FROM about WHERE id = 1 LIMIT 1";
    $about = $conn->query($sql)->fetch_assoc();
?>
<!-- About Us Section -->
<section class="section" id="about">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">About us</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            Learn. Grow. Succeed with <span class="academy-name">Bright Future Academy</span>.
        </p>
        
        <div class="row mt-5">
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="about-card">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Who we are</h4>
                    <p><?php echo $about['who']; ?></p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="about-card">
                    <div class="card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h4>Our Aim</h4>
                    <p><?php echo $about['aim']; ?></p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="about-card">
                    <div class="card-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4>What We Provide</h4>
                    <p><?php echo $about['service']; ?></p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="500">
                <div class="about-card">
                    <div class="card-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>Why Choose Us</h4>
                    <p><?php echo $about['why']; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>