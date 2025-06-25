<style>
  :root {
    --primary: #6366f1;
    --primary-light: #818cf8;
    --dark: #1e293b;
    --light: #f8fafc;
    --gray: #94a3b8;
    --gray-light: #e2e8f0;
    --success: #10b981;
  }
  .pricing-section {
    padding: 5rem 0;
    position: relative;
  }
  
  .pricing-container {
    max-width: 1200px;
    margin: 0 auto;
  }

  .price-savings {
    background-color: var(--primary-light);
    color: white;
    font-size: 0.7rem;
    padding: 0.2rem 0.5rem;
    border-radius: 1rem;
    font-weight: 700;
  }
  
  .pricing-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
  }
  
  .pricing-card {
    background: white;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
    position: relative;
    border: 1px solid var(--gray-light);
  }
  
  .pricing-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  }
  
  .pricing-card.recommended {
    border: 1px solid var(--primary-light);
    box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3), 0 4px 6px -2px rgba(99, 102, 241, 0.1);
  }
  
  .plan-name {
    font-size: 1.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
  }
  
  .plan-description {
    color: var(--gray);
    margin-bottom: 1.5rem;
  }
  
  .plan-price {
    margin-bottom: 2rem;
    display: flex;
    align-items: flex-end;
    gap: 0.5rem;
  }
  
  .price-amount {
    font-size: 2rem;
    font-weight: 800;
    line-height: 1;
    font-family: serif;
  }
  
  .price-duration {
    color: var(--gray);
    font-size: 1rem;
    margin-bottom: 0.5rem;
  }
  
  .plan-features {
    margin-bottom: 2.5rem;
  }
  
  .feature-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.25rem;
  }
  
  .fa-check-circle {
    color: var(--success);
    font-size: 1.25rem;
    margin-top: 0.2rem;
  }
  .fa-times-circle {
    color: var(--gray);
    font-size: 1.25rem;
    margin-top: 0.2rem;
  }
      
  .feature-name {
    font-weight: 600;
  }
  
  .plan-button {
    width: 100%;
    padding: 1rem;
    border-radius: 0.5rem;
    font-weight: 700;
    transition: all 0.3s ease;
    border: 2px solid transparent;
  }
  
  .btn-primary {
    background: var(--primary);
    color: white;
  }
  
  .btn-primary:hover {
    background: #4f46e5;
    transform: translateY(-2px);
  }
  
  .btn-outline {
    background: transparent;
    border-color: var(--primary);
    color: var(--primary);
  }
  
  .btn-outline:hover {
    background: var(--primary-light);
    color: white;
    transform: translateY(-2px);
  }
      
  @media (max-width: 768px) {
    
    .pricing-cards {
      grid-template-columns: 1fr;
    }
  }
</style>
<?php
  $sql = "SELECT * FROM consultant WHERE id = 1";
  $result1 = mysqli_fetch_assoc(mysqli_query($conn, $sql));
  $sql = "SELECT * FROM consultant WHERE id = 2";
  $result2 = mysqli_fetch_assoc(mysqli_query($conn, $sql));
?>
<section class="pricing-section">
  <div class="container pricing-container">      
    <div class="pricing-cards">
      <div class="pricing-card recommended">
        <h3 class="plan-name"><?= $result1['title']; ?></h3>
        <p class="plan-description">ব্যক্তিগত ব্যবহারের জন্য উপযুক্ত একটি বিনামূল্যের প্ল্যান</p>
        
        <div class="plan-price">
          <span class="price-amount">৳<?=$result1['price']?></span>
          <!-- <span class="price-duration">/month</span> -->
        </div>
        
        <div class="plan-features">
          <div class="feature-item">
              <i class="fas fa-check-circle feature-check"></i>
              <div class="feature-name">চ্যাট</div>
          </div>
          <div class="feature-item">
              <i class="fas fa-times-circle feature-check"></i>
              <div class="feature-name">ভিডিও কনফারেন্স</div>
          </div>
          <div class="feature-item">
              <i class="fas fa-times-circle feature-check"></i>
              <div class="feature-name">বিশেষ নোটস</div>
          </div>
          <div class="feature-item">
              <i class="fas fa-times-circle feature-check"></i>
              <div class="feature-name">মেডিক্যাল টিপস</div>
          </div>
        </div>

        <button class="plan-button btn-primary" onclick="location.href = 'cart/add.php?thanks=<?=encryptSt(1)?>&nani=<?=encryptSt(0)?>&type=consultant'">ফ্রীতে শুরু করুন</button>
      </div>
      
      <div class="pricing-card">
        <h3 class="plan-name"><?= $result2['title']; ?></h3>
        <p class="plan-description">ব্যক্তিগত ব্যবহারের জন্য উপযুক্ত একটি প্ল্যান</p>

        <div class="plan-price">
          <span class="price-amount">৳<?=$result2['price']?></span>
          <span class="price-duration">/ ৩ মাস</span>
          <span class="price-savings">সেভ ২৫%</span>
        </div>
        
        <div class="plan-features">
          <div class="feature-item">
              <i class="fas fa-check-circle feature-check"></i>
              <div class="feature-name">চ্যাট</div>
          </div>
          <div class="feature-item">
              <i class="fas fa-check-circle feature-check"></i>
              <div class="feature-name">ভিডিও কনফারেন্স</div>
          </div>
          <div class="feature-item">
              <i class="fas fa-check-circle feature-check"></i>
              <div class="feature-name">বিশেষ নোটস</div>
          </div>
          <div class="feature-item">
              <i class="fas fa-check-circle feature-check"></i>
              <div class="feature-name">মেডিক্যাল টিপস</div>
          </div>
        </div>

        <button class="plan-button btn-outline" onclick="location.href = 'cart/add.php?thanks=<?=encryptSt(2)?>&nani=<?=encryptSt(90)?>&type=consultant'">সাবস্ক্রাইব করুন</button>
      </div>
    </div>
  </div>
</section>

<script>
  document.querySelectorAll('.pricing-card').forEach(card => {
    card.addEventListener('mouseenter', () => {
      card.style.transform = 'translateY(-5px)';
      card.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
    });
    
    card.addEventListener('mouseleave', () => {
      card.style.transform = '';
      card.style.boxShadow = '';
    });
  });
</script>