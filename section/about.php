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

    /* Developer Section */
    .main-sec-dev {
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        color: var(--light);
        border-radius: 20px;
        padding: 50px 20px;
        margin-top: 60px;
    }

    .profile-card {
        max-width: 900px;
        margin: auto;
        background: rgba(255, 255, 255, 0.07);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        overflow: hidden;
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.1);
        transition: 0.3s;
    }

    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.3);
    }

    .profile-sidebar {
        padding: 40px 20px;
        text-align: center;
        background: rgba(0,0,0,0.25);
    }

    .profile-img-container {
        position: relative;
        width: 160px;
        height: 160px;
        margin: auto auto 25px;
    }

    .profile-img {
        width: 100%; height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid transparent;
        background: linear-gradient(45deg, var(--primary), var(--accent)) border-box;
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }

    .profile-title h2 {
        font-size: 22px;
        font-weight: 600;
        color: white;
    }

    .profile-title p {
        font-size: 15px;
        color: rgba(255,255,255,0.7);
        margin: 3px 0;
    }

    .profile-title span {
        font-size: 13px;
        color: var(--accent);
    }

    .contact-info {
        margin-top: 20px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }

    .contact-item a {
        color: inherit;
        text-decoration: none;
        margin: 0;
    }

    .contact-item:hover {
        color: var(--accent);
    }

    .social-links {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-top: 20px;
    }

    .social-links a {
        width: 38px;
        height: 38px;        
        display: flex !important;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        background: rgba(255,255,255,0.15);
        font-size: 16px;
        color: white;
        transition: 0.3s;
    }

    .social-links a:hover {
        background: var(--accent);
        transform: scale(1.1);
    }

    .profile-content {
        padding: 40px 30px;
    }

    .profile-section-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--accent);
        position: relative;
    }

    .section-title {
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        color: var(--accent);
        margin-bottom: 20px;
        position: relative;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -5px; left: 50%;
        transform: translateX(-50%);
        width: 60px; height: 3px;
        background: var(--gold);
        border-radius: 2px;
    }

    .profile-section-title::after {
        content: '';
        position: absolute;
        bottom: -5px; left: 0;
        width: 40px; height: 3px;
        background: var(--gold);
        border-radius: 2px;
    }

    .about-text {
        font-size: 15px;
        line-height: 1.7;
        color: rgba(255,255,255,0.85);
    }

    .skills-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .skill {
        background: rgba(76,201,240,0.1);
        color: var(--accent);
        padding: 7px 14px;
        border-radius: 18px;
        font-size: 13px;
        border: 1px solid rgba(76,201,240,0.3);
        transition: 0.3s;
    }

    .skill:hover {
        background: var(--accent);
        color: var(--dark);
    }

    .btn-contact {
        margin-top: 15px;
        display: inline-block;
        padding: 10px 25px;
        background: linear-gradient(45deg, var(--primary), var(--secondary));
        border-radius: 25px;
        font-size: 14px;
        font-weight: 600;
        color: white;
        text-decoration: none;
        transition: 0.3s;
        text-align: center;
        z-index: 999;
    }

    .btn-contact:hover {
        background: linear-gradient(45deg, var(--secondary), var(--primary));
        transform: translateY(-3px);
    }

    .address-info {
        display: flex;
        align-items: center;
        font-size: 14px;
        color: rgba(255,255,255,0.85);
    }

    .address-info i {
        margin-right: 8px;
        color: var(--accent);
    }

    @media (max-width: 768px) {
        .profile-card {
            grid-template-columns: 1fr;
        }
        .profile-content, .profile-sidebar {
            padding: 25px 20px;
        }
    }
</style>


<!-- About Us Section -->
<section class="section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">আমাদের সম্পর্কে</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
            শিখো। বেড়ে উঠো। সফল হও <span class="academy-name">ব্রাইট ফিউচার একাডেমি</span> এর সাথে।
        </p>
        
        <div class="row mt-5">
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="about-card">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>আমরা কে</h4>
                    <p>
                        ব্রাইট ফিউচার একাডেমি শিক্ষার্থীদের জ্ঞান, ব্যবহারিক দক্ষতা 
                        ও আত্মবিশ্বাস অর্জনে সহায়তা করতে প্রতিশ্রুতিবদ্ধ। 
                        আমরা বিশ্বাস করি শিক্ষা হওয়া উচিত আনন্দদায়ক, অনুপ্রেরণামূলক 
                        এবং ফলপ্রসূ। আমাদের লক্ষ্য হলো প্রতিটি শিক্ষার্থীকে 
                        শিক্ষাগত সফলতা ও ভবিষ্যৎ ক্যারিয়ারের জন্য প্রস্তুত করা।
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="about-card">
                    <div class="card-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h4>আমাদের লক্ষ্য</h4>
                    <p>
                        একটি বিশ্বমানের শিক্ষার পরিবেশ তৈরি করা যেখানে শিক্ষার্থীরা 
                        তাদের সম্ভাবনা আবিষ্কার করতে পারবে, উৎকর্ষ অর্জন করবে এবং 
                        নিজ নিজ ক্ষেত্রে ভবিষ্যতের নেতা হয়ে উঠবে।
                    </p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="about-card">
                    <div class="card-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4>আমরা কী দিই</h4>
                    <p>
                        আমরা একাডেমিক কোচিং, দক্ষতা উন্নয়ন প্রশিক্ষণ, প্রতিযোগিতামূলক 
                        পরীক্ষার প্রস্তুতি এবং ব্যক্তিগত মেন্টরশিপ প্রদান করি, যাতে 
                        প্রতিটি শিক্ষার্থী তাদের যাত্রায় সফল হতে পারে।
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="500">
                <div class="about-card">
                    <div class="card-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>কেন আমাদের বেছে নেবেন</h4>
                    <p>
                        অভিজ্ঞ প্রশিক্ষক, আধুনিক শিক্ষণ পদ্ধতি এবং শিক্ষার্থী-কেন্দ্রিক 
                        দৃষ্টিভঙ্গির মাধ্যমে আমরা এমন মানসম্মত শিক্ষা প্রদান করি 
                        যা কেবল জ্ঞান নয়, আত্মবিশ্বাসও গড়ে তোলে।
                    </p>
                </div>
            </div>
        </div>

        <!-- Developer Section -->
        <div class="developer" data-aos="fade-up" data-aos-delay="600">
            <h3 class="section-title">ডেভেলপার পরিচিতি</h3>
            <div class="main-sec-dev">
                <!-- Animated background elements -->
                <div class="bg-elements">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                
                <!-- Profile Card -->
                <div class="profile-card">
                    <!-- Sidebar with profile image and basic info -->
                    <div class="profile-sidebar">
                        <div class="profile-img-container">
                            <img src="img/abdur.jpg" alt="Abdur Rahman" class="profile-img">
                        </div>
                        
                        <div class="profile-title">
                            <h2>Abdur Rahman</h2>
                            <p>Android & Web Developer</p>
                            <span>Developer & Designer</span>
                        </div>
                        
                        <div class="contact-info">
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:abdur09266@gmail.com">abdur09266@gmail.com</a>
                            </div>
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <a href="tel:+8801709409266">+8801709409266</a>
                            </div>
                            <div class="contact-item">
                                <i class="fab fa-whatsapp"></i>
                                <a href="https://wa.me/8801709409266">Chat on WhatsApp</a>
                            </div>
                        </div>
                        
                        <div class="social-links">
                            <a href="https://facebook.com/abdur.developer" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.linkedin.com/in/abdur-developer/" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                            <a href="https://github.com/abdur-developer" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                    
                    <!-- Main content area -->
                    <div class="profile-content">
                        <div class="section">
                            <h3 class="section-title">About Me</h3>
                            <p class="about-text">
                                I'm Md Abdur Rahman, an Android app and web developer with 4 years of experience. 
                                I specialize in designing and building user-centered mobile and web solutions that 
                                deliver functionality and ease of use. My goal is to create impactful digital 
                                experiences that meet clients' needs effectively.
                            </p>
                            <a href="https://wa.me/8801709409266" class="btn-contact">Send Message</a>
                        </div>
                        
                        <div class="section">
                            <h3 class="section-title">Skills</h3>
                            <div class="skills-container">
                                <span class="skill">HTML</span>
                                <span class="skill">CSS</span>
                                <span class="skill">Bootstrap</span>
                                <span class="skill">XML</span>
                                <span class="skill">JavaScript</span>
                                <span class="skill">Java</span>
                                <span class="skill">PHP</span>
                                <span class="skill">C++</span>
                                <span class="skill">MySQL</span>
                                <span class="skill">WordPress</span>
                            </div>
                        </div>
                        
                        <div class="section">
                            <h3 class="section-title">Location</h3>
                            <div class="address-info">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Debigong, Panchagarh, Bangladesh</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
