<style>
    /* Footer */
    footer {
        background: var(--dark);
        color: white;
        padding: 20px 0;
        position: relative;
    }

    .footer-logo {
        margin-bottom: 20px;
    }

    .footer-about {
        opacity: 0.8;
        margin-bottom: 20px;
    }

    .footer-links h5 {
        color: white;
        margin-bottom: 20px;
        font-weight: 600;
        position: relative;
        padding-bottom: 10px;
    }

    .footer-links h5:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
        background: var(--accent);
    }

    .footer-links a, .developer a {
        color: rgba(255,255,255,0.7);
        display: block;
        margin-bottom: 10px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .footer-links a:hover, .developer a:hover {
        color: var(--accent);
        padding-left: 5px;
    }

    .social-icons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: rgba(255,255,255,0.1);
        color: white;
        border-radius: 50%;
        margin-right: 10px;
        transition: all 0.3s ease;
    }

    .social-icons a:hover {
        background: var(--accent);
        transform: translateY(-3px);
    }

    .contact-info p {
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .contact-info i {
        margin-right: 10px;
        color: var(--accent);
        width: 20px;
    }

    .copyright {
        text-align: center;
        color: rgba(255,255,255,0.5);
        font-size: 0.9rem;
    }
</style>
<!-- Footer -->
 <?php
    $sql = "SELECT * FROM contact WHERE id=1";
    $contact = mysqli_fetch_assoc(mysqli_query($conn, $sql));
 ?>
<footer>
    <div class="container">
        <?php if($showDev): ?>
            <div class="row" style="margin-bottom: 40px;">
                <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up">
                    <div class="footer-logo">
                        <img src="img/logo.jpg" alt="Abdur" width="50" style="border-radius: 50%;">
                    </div>
                    <p class="footer-about">
                        Prepare for all jobs from home.
                    </p>
                    
                    <div class="social-icons mt-4">
                        <a href="<?= htmlspecialchars($contact['facebook']) ?>" style="text-decoration: none;"><i class="fab fa-facebook-f"></i></a>
                        <a href="<?= htmlspecialchars($contact['youtube']) ?>" style="text-decoration: none;"><i class="fab fa-youtube"></i></a>
                        <a href="<?= htmlspecialchars($contact['tiktok']) ?>" style="text-decoration: none;"><i class="fab fa-tiktok"></i></a>
                        <a href="<?= htmlspecialchars($contact['instagram']) ?>" style="text-decoration: none;"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                    <div class="footer-links">
                        <h5>Links</h5>
                        <a href="#">Home</a>
                        <a href="?circular#circular">Circulars</a>
                        <a href="?courses#courses">Courses</a>
                        <a href="?about#about">About Us</a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="footer-links">
                        <h5>Courses</h5>
                        <a href="?courses">Armed Forces</a>
                        <a href="?courses">BCS Preparation</a>
                        <a href="?courses">Bank Jobs</a>
                        <a href="?courses">Police & Ansar</a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="footer-links">
                        <h5>Contact us</h5>
                        <div class="contact-info">
                            <p><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($contact['location']) ?></p>
                            <p><i class="fas fa-phone-alt"></i> <?= htmlspecialchars($contact['number']) ?></p>
                            <p><i class="fas fa-envelope"></i> <?= htmlspecialchars($contact['email']) ?></p>
                            <p><a href="abdurrahman.php"><i class="fas fa-link"></i> <span>Developer</span></a></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="copyright">
            <!--
            <footer class="site-credit">
                <p>Website Developed by Abdur Rahman</p>
                <p>Email: abdur09266@gmail.com</p>
                <p>Whatsapp: +8801709409266</p>
                <p>for more details visit : https://defence24bd.com/abdurrahman.php</p>
            </footer>
            -->
            <p class="mb-0">
                <!-- <a href="abdurrahman.php"><i class="fas fa-link"></i></a> -->
                 <?= date('Y'); ?> ProtiSheba . All rights reserved. | সকল স্বত্ব সংরক্ষিত 
            </p>
            <!-- <p class="developer">
                <a href="abdurrahman.php">
                    <i class="fas fa-link"></i> Developed by Abdur Rahman
                </a>
            </p> -->
        </div>
    </div>
</footer>