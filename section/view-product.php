<?php
    $getId = $_GET['product-details'];
    $product_id = decryptSt($getId);
    if (!$product_id) {
        echo "<p class='text-center'>Invalid product request.</p>";
        exit;
    }
    $sql = "SELECT * FROM product WHERE id ='$product_id'";
    $product = mysqli_fetch_assoc(mysqli_query($conn, $sql));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$product['name']?></title>
  <style>
    :root {
      --primary: #2a6b7e;
      --primary-light: #e8f4f8;
      --secondary: #f5a623;
      --text: #333333;
      --text-light: #666666;
      --bg: #ffffff;
      --border: #e0e0e0;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      color: var(--text);
      background-color: #fafafa;
      line-height: 1.5;
      padding: 0;
    }
    
    .container-product {
      max-width: 1200px;
      margin: 60px auto 40px;
      padding: 0 20px;
    }
    
    .product-view {
      display: flex;
      gap: 60px;
      background: var(--bg);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 24px rgba(0, 0, 0, 0.05);
    }
    
    .product-gallery {
      flex: 1;
      padding: 30px;
      background: var(--primary-light);
    }
    
    .main-image {
      width: 100%;
      height: 500px;
      object-fit: contain;
      border-radius: 8px;
    }
    
    .product-info {
      flex: 1;
      padding: 40px 40px 40px 0;
    }
    
    .brand {
      color: var(--primary);
      font-size: 14px;
      font-weight: 600;
      letter-spacing: 0.5px;
      margin-bottom: 8px;
      text-transform: uppercase;
    }
    
    .product-title {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 16px;
      line-height: 1.3;
    }
    
    .price-section {
      margin: 24px 0;
    }
    
    .current-price {
      font-size: 28px;
      font-weight: 700;
      color: var(--primary);
    }
    
    .price-note {
      font-size: 14px;
      color: var(--text-light);
      margin-top: 4px;
    }
    
    .rating {
      display: flex;
      align-items: center;
      gap: 8px;
      margin: 20px 0;
    }
    
    .stars {
      color: var(--secondary);
      letter-spacing: 2px;
    }
    
    .review-count {
      font-size: 14px;
      color: var(--text-light);
    }
    
    .description {
      margin: 28px 0;
      color: var(--text-light);
    }
    
    .benefits {
      margin: 28px 0;
    }
    
    .benefit-item {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      margin-bottom: 12px;
    }
    
    .benefit-icon {
      color: var(--primary);
      font-weight: bold;
      margin-top: 2px;
    }
    
    .add-to-cart {
      width: 100%;
      padding: 16px;
      background-color: var(--primary);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s;
      margin-top: 32px;
    }
    
    .add-to-cart:hover {
      background-color: #1d5565;
      transform: translateY(-1px);
    }
    
    .shipping-info {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 16px;
      font-size: 14px;
      color: var(--text-light);
    }
    
    .testimonial {
      background: var(--primary-light);
      padding: 20px;
      border-radius: 8px;
      margin-top: 40px;
    }
    
    .testimonial-content {
      font-style: italic;
      margin-bottom: 12px;
    }
    
    .testimonial-author {
      font-weight: 600;
      font-size: 14px;
    }
    
    @media (max-width: 900px) {
      .product-view {
        flex-direction: column;
        gap: 20px;
      }
      
      .product-info {
        padding: 20px;
      }
      
      .main-image {
        height: 400px;
      }
    }
  </style>
</head>
<body>
  <div class="container-product">
    <div class="product-view">
      <div class="product-gallery">
        <img src="<?=$product['img']?>" alt="<?=$product['name']?>" class="main-image">
      </div>
      
      <div class="product-info">
        <div class="brand"><?=$product['type']?></div>
        <h1 class="product-title"><?=$product['name']?></h1>
        
        <div class="rating">
          <div class="stars">★★★★★</div>
          <span class="review-count"><?=$product['rating_count']?> reviews</span>
        </div>
        
        <div class="price-section">
          <div class="current-price">৳ <?=$product['price']?></div>
          <!-- <div class="price-note">or 4 interest-free payments of $17.25</div> -->
        </div>
        
        <p class="description"><?=$product['description']?></p>
        
        <!-- <div class="benefits">
          <div class="benefit-item">
            <span class="benefit-icon">✓</span>
            <span>72-hour hydration with Arctic Spring Water</span>
          </div>
          <div class="benefit-item">
            <span class="benefit-icon">✓</span>
            <span>Hyaluronic Acid Complex plumps fine lines</span>
          </div>
          <div class="benefit-item">
            <span class="benefit-icon">✓</span>
            <span>Non-comedogenic & fragrance-free</span>
          </div>
        </div> -->

        <button class="add-to-cart" onclick="addToCart('<?=$getId?>')">Add to Cart</button>

        <!-- <div class="shipping-info">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor">
            <path d="M5 13l4 4L19 7"></path>
          </svg>
          <span>Free shipping & returns</span>
        </div> -->
        
        <div class="testimonial">
          <p class="testimonial-content">"<?=$product['review']?>"</p>
          <div class="testimonial-author">— Abdur Rahman, Verified Buyer</div>
        </div>
      </div>
    </div>
    <script>
        function addToCart(productId) {
            window.location.href = "cart/add.php?thanks=" + productId + "&type=product";
        }
    </script>
  </div>
</body>
</html>