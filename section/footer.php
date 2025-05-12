<style>
    /* Footer */
    footer {
        background: var(--dark);
        color: white;
        padding: 80px 0 20px;
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

    .footer-links a {
        color: rgba(255,255,255,0.7);
        display: block;
        margin-bottom: 10px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .footer-links a:hover {
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
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 20px;
        margin-top: 40px;
        text-align: center;
        color: rgba(255,255,255,0.5);
        font-size: 0.9rem;
    }
</style>
<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up">
                <div class="footer-logo">
                    <img src="/images/Logo-Final.png" alt="Abdur" width="150">
                </div>
                <p class="footer-about">
                    সকল চাকরির প্রস্তুতি নিন ঘরে বসে। আমাদের প্ল্যাটফর্মে আপনি পাবেন সামরিক ও বেসামরিক চাকরির সম্পূর্ণ প্রস্তুতি।
                </p>
                
                <div class="social-icons mt-4">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="100">
                <div class="footer-links">
                    <h5>লিংকস</h5>
                    <a href="/bn">হোম</a>
                    <a href="/bn/about">আমাদের সম্পর্কে</a>
                    <a href="/bn/circular">সার্কুলার</a>
                    <a href="/bn/all-courses">কোর্সসমূহ</a>
                    <a href="/bn/contact">যোগাযোগ</a>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 mb-4 mb-md-0" data-aos="fade-up" data-aos-delay="200">
                <div class="footer-links">
                    <h5>কোর্স</h5>
                    <a href="#">সামরিক বাহিনী</a>
                    <a href="#">বিসিএস প্রস্তুতি</a>
                    <a href="#">ব্যাংক জব</a>
                    <a href="#">পুলিশ ও আনসার</a>
                    <a href="#">শিক্ষক নিবন্ধন</a>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="footer-links">
                    <h5>যোগাযোগ</h5>
                    <div class="contact-info">
                        <p><i class="fas fa-map-marker-alt"></i> ১২৩/বি, ঢাকা, বাংলাদেশ</p>
                        <p><i class="fas fa-phone-alt"></i> +৮৮০ ১৭১২ ৩৪৫৬৭৮</p>
                        <p><i class="fas fa-envelope"></i> info@abdurltd.com</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="copyright">
            <p class="mb-0">© 2023 Abdur Ltd. সকল স্বত্ব সংরক্ষিত</p>
        </div>
    </div>
</footer>