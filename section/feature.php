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
        <h2 class="section-title" data-aos="fade-up">কেন আমাদের প্ল্যাটফর্ম বেছে নিবেন?</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">আমাদের বিশেষ সুবিধাগুলো যা আপনাকে চাকরি প্রস্তুতিতে এগিয়ে রাখবে</p>
        
        <div class="row mt-5">
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h4 class="feature-title">অভিজ্ঞ প্রশিক্ষক</h4>
                    <p class="feature-text">সামরিক ও বেসামরিক চাকরির অভিজ্ঞ প্রশিক্ষকদের থেকে সরাসরি শিখুন</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4 class="feature-title">মোবাইল ফ্রেন্ডলি</h4>
                    <p class="feature-text">যেকোনো স্মার্টফোন থেকে যেকোনো সময় অ্যাক্সেস করুন কোর্স ম্যাটেরিয়াল</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 class="feature-title">২৪/৭ সাপোর্ট</h4>
                    <p class="feature-text">যেকোনো সমস্যায় আমাদের বিশেষজ্ঞ টিম সবসময় আপনার পাশে আছে</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h4 class="feature-title">মডেল টেস্ট</h4>
                    <p class="feature-text">প্রকৃত পরীক্ষার অনুরূপ মডেল টেস্ট দিয়ে নিজেকে যাচাই করুন</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4 class="feature-title">প্রোগ্রেস ট্র্যাকিং</h4>
                    <p class="feature-text">আপনার অগ্রগতি মনিটর করুন এবং দুর্বলতা চিহ্নিত করুন</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4 class="feature-title">সার্টিফিকেট</h4>
                    <p class="feature-text">কোর্স সম্পন্ন করলে পাবেন স্বীকৃতিপত্র যা আপনার সিভিকে শক্তিশালী করবে</p>
                </div>
            </div>
        </div>
    </div>
</section>