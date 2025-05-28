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
            <?php
            $sql = "SELECT * FROM testimonials ORDER BY id DESC LIMIT 3";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){ ?>
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-card">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text"><?=$row['message']?></p>
                    <div class="testimonial-author">
                        <img src="<?=$row['img']?>" alt="Student">
                        <div class="author-info">
                            <h5><?=$row['name']?></h5>
                            <p><?=$row['sector']?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>