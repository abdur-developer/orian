<style>        
    /* Testimonials */
    .testimonial-card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        position: relative;
        margin-bottom: 30px;
    }

    .testimonial-card:before {
        content: '"';
        position: absolute;
        top: 20px;
        left: 20px;
        font-size: 5rem;
        color: rgba(67, 97, 238, 0.1);
        font-family: serif;
        line-height: 1;
    }

    .testimonial-rating {
        color: var(--warning);
        margin-bottom: 15px;
    }

    .testimonial-text {
        font-style: italic;
        color: #555;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .testimonial-author {
        display: flex;
        align-items: center;
    }

    .testimonial-author img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 3px solid var(--accent);
    }

    .author-info h5 {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0;
    }

    .author-info p {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

</style>
<!-- Testimonials Section -->
<section class="section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">শিক্ষার্থীদের কথা</h2>
        <p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">আমাদের সফল শিক্ষার্থীদের অভিজ্ঞতা</p>
        
        <div class="row mt-5">
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Abdur Ltd এর কোর্সের মাধ্যমে আমি বাংলাদেশ সেনাবাহিনীতে সৈনিক পদে চাকরি পেয়েছি। 
                        তাদের স্টাডি ম্যাটেরিয়াল এবং মডেল টেস্ট আমার প্রস্তুতিতে অনেক সাহায্য করেছে।"
                    </p>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Student">
                        <div class="author-info">
                            <h5>মোহাম্মদ রাকিব</h5>
                            <p>বাংলাদেশ সেনাবাহিনী</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "ISSB প্রস্তুতির জন্য Abdur Ltd এর কোর্স আমার জন্য খুবই সহায়ক ছিল। বিশেষ করে সাইকোলজিক্যাল 
                        টেস্ট সম্পর্কে বিস্তারিত জানতে পেরেছিলাম যা আমাকে চূড়ান্ত নির্বাচনে সাহায্য করেছে।"
                    </p>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Student">
                        <div class="author-info">
                            <h5>আয়শা সিদ্দিকা</h5>
                            <p>বাংলাদেশ বিমানবাহিনী</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="testimonial-text">
                        "বাংলাদেশ নৌবাহিনীতে অফিসার পদে চাকরি পাওয়ার ক্ষেত্রে Abdur Ltd এর মডেল টেস্ট এবং 
                        ইন্টারভিউ প্রস্তুতি আমার জন্য খুবই কার্যকরী প্রমাণিত হয়েছে।"
                    </p>
                    <div class="testimonial-author">
                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Student">
                        <div class="author-info">
                            <h5>ইমরান হোসেন</h5>
                            <p>বাংলাদেশ নৌবাহিনী</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>