<style>    
    .product-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
    .product-img-container {
        height: 200px;
        overflow: hidden;
        position: relative;
        background: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .product-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }
    
    .product-card:hover .product-img {
        transform: scale(1.05);
    }
    
    .product-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: var(--accent-color);
        color: white;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        z-index: 1;
    }
    
    .product-wishlist {
        position: absolute;
        top: 12px;
        right: 12px;
        background: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .product-wishlist:hover {
        color: var(--accent-color);
        transform: scale(1.1);
    }
    
    .product-body {
        padding: 16px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .product-category {
        color: var(--text-light);
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }
    
    .product-name {
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 8px;
        color: var(--text-dark);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .product-rating {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .product-rating-stars {
        color: #f59e0b;
        font-size: 14px;
        margin-right: 5px;
    }
    
    .product-rating-count {
        color: var(--text-light);
        font-size: 12px;
    }
    
    .product-price {
        margin-top: auto;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .current-price {
        font-weight: 700;
        font-size: 18px;
        color: var(--primary-color);
    }
    
    .original-price {
        font-size: 14px;
        color: var(--text-light);
        text-decoration: line-through;
    }
    
    .discount {
        font-size: 12px;
        font-weight: 600;
        color: var(--accent-color);
        background: #fee2e2;
        padding: 2px 6px;
        border-radius: 4px;
    }
    
    .product-actions {
        display: flex;
        gap: 8px;
        margin-top: 15px;
    }
    
    .btn-add-to-cart {
        flex: 1;
        background: var(--primary-color);
        color: white;
        border: none;
        padding: 8px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .btn-add-to-cart:hover {
        background: var(--secondary-color);
    }
    
    .btn-quick-view {
        width: 40px;
        background: white;
        color: var(--text-medium);
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    
    .btn-quick-view:hover {
        background: #f3f4f6;
        color: var(--primary-color);
    }
    
    @media (max-width: 768px) {
        .product-img-container {
            height: 180px;
        }
        
        .product-name {
            font-size: 15px;
        }
        
        .current-price {
            font-size: 16px;
        }
        
        .product-actions {
            flex-direction: column;
            gap: 8px;
        }
        
        .btn-quick-view {
            width: 100%;
        }
    }
</style>

<section>
    <div class="container">
        <h2 class="section-title">Our Products</h2>
        
        <div class="row g-4">
            <!-- Product 1 -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-card">
                    <div class="product-img-container">
                        <span class="product-badge">Sale</span>
                        <div class="product-wishlist">
                            <i class="far fa-heart"></i>
                        </div>
                        <img src="https://m.media-amazon.com/images/I/61sGz5EM9FL._AC_UL480_FMwebp_QL65_.jpg" class="product-img" alt="Smart Watch X1">
                    </div>
                    <div class="product-body">
                        <span class="product-category">Smart Watch</span>
                        <h3 class="product-name">Amazfit GTS 4 Smart Watch with Bluetooth Calling</h3>
                        <div class="product-rating">
                            <div class="product-rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="product-rating-count">(142)</span>
                        </div>
                        <div class="product-price">
                            <span class="current-price">৳12,999</span>
                            <span class="original-price">৳15,999</span>
                            <span class="discount">19% off</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-add-to-cart">Add to Cart</button>
                            <button class="btn btn-quick-view"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-card">
                    <div class="product-img-container">
                        <div class="product-wishlist">
                            <i class="far fa-heart"></i>
                        </div>
                        <img src="https://oriangroup.com/wp-content/uploads/2024/10/2-5.png" class="product-img" alt="Smart Watch X2">
                    </div>
                    <div class="product-body">
                        <span class="product-category">Smart Watch</span>
                        <h3 class="product-name">Fire-Boltt Phoenix Smart Watch with Bluetooth Calling</h3>
                        <div class="product-rating">
                            <div class="product-rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="product-rating-count">(89)</span>
                        </div>
                        <div class="product-price">
                            <span class="current-price">৳9,499</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-add-to-cart">Add to Cart</button>
                            <button class="btn btn-quick-view"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product 3 -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-card">
                    <div class="product-img-container">
                        <span class="product-badge">New</span>
                        <div class="product-wishlist">
                            <i class="far fa-heart"></i>
                        </div>
                        <img src="https://oriangroup.com/wp-content/uploads/2024/10/2-5.png" class="product-img" alt="Smart Watch X3">
                    </div>
                    <div class="product-body">
                        <span class="product-category">Smart Watch</span>
                        <h3 class="product-name">Noise ColorFit Pulse Grand Smart Watch</h3>
                        <div class="product-rating">
                            <div class="product-rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="product-rating-count">(256)</span>
                        </div>
                        <div class="product-price">
                            <span class="current-price">৳11,299</span>
                            <span class="original-price">৳12,999</span>
                            <span class="discount">13% off</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-add-to-cart">Add to Cart</button>
                            <button class="btn btn-quick-view"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product 4 -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-card">
                    <div class="product-img-container">
                        <div class="product-wishlist">
                            <i class="far fa-heart"></i>
                        </div>
                        <img src="https://oriangroup.com/wp-content/uploads/2024/10/2-5.png" class="product-img" alt="Smart Watch X4">
                    </div>
                    <div class="product-body">
                        <span class="product-category">Smart Watch</span>
                        <h3 class="product-name">boAt Wave Call Smart Watch with Bluetooth Calling</h3>
                        <div class="product-rating">
                            <div class="product-rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="product-rating-count">(312)</span>
                        </div>
                        <div class="product-price">
                            <span class="current-price">৳10,799</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-add-to-cart">Add to Cart</button>
                            <button class="btn btn-quick-view"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            <!-- Product 1 -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-card">
                    <div class="product-img-container">
                        <span class="product-badge">Bestseller</span>
                        <div class="product-wishlist">
                            <i class="far fa-heart"></i>
                        </div>
                        <img src="https://oriangroup.com/wp-content/uploads/2024/10/2-5.png" class="product-img" alt="Book 1">
                    </div>
                    <div class="product-body">
                        <span class="product-category">Self-help</span>
                        <h3 class="product-name">Atomic Habits: The life-changing million copy bestseller</h3>
                        <div class="product-rating">
                            <div class="product-rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="product-rating-count">(12,456)</span>
                        </div>
                        <div class="product-price">
                            <span class="current-price">৳599</span>
                            <span class="original-price">৳799</span>
                            <span class="discount">25% off</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-add-to-cart">Add to Cart</button>
                            <button class="btn btn-quick-view"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product 2 -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-card">
                    <div class="product-img-container">
                        <div class="product-wishlist">
                            <i class="far fa-heart"></i>
                        </div>
                        <img src="https://oriangroup.com/wp-content/uploads/2024/10/2-5.png" class="product-img" alt="Book 2">
                    </div>
                    <div class="product-body">
                        <span class="product-category">Fiction</span>
                        <h3 class="product-name">The Psychology of Money: Timeless lessons on wealth</h3>
                        <div class="product-rating">
                            <div class="product-rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <span class="product-rating-count">(8,742)</span>
                        </div>
                        <div class="product-price">
                            <span class="current-price">৳449</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-add-to-cart">Add to Cart</button>
                            <button class="btn btn-quick-view"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product 3 -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-card">
                    <div class="product-img-container">
                        <span class="product-badge">New</span>
                        <div class="product-wishlist">
                            <i class="far fa-heart"></i>
                        </div>
                        <img src="https://oriangroup.com/wp-content/uploads/2024/10/2-5.png" class="product-img" alt="Book 3">
                    </div>
                    <div class="product-body">
                        <span class="product-category">Business</span>
                        <h3 class="product-name">Do It Today: Overcome procrastination</h3>
                        <div class="product-rating">
                            <div class="product-rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="product-rating-count">(3,215)</span>
                        </div>
                        <div class="product-price">
                            <span class="current-price">৳399</span>
                            <span class="original-price">৳499</span>
                            <span class="discount">20% off</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-add-to-cart">Add to Cart</button>
                            <button class="btn btn-quick-view"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Product 4 -->
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="product-card">
                    <div class="product-img-container">
                        <div class="product-wishlist">
                            <i class="far fa-heart"></i>
                        </div>
                        <img src="https://oriangroup.com/wp-content/uploads/2024/10/2-5.png" class="product-img" alt="Book 4">
                    </div>
                    <div class="product-body">
                        <span class="product-category">Biography</span>
                        <h3 class="product-name">Elon Musk: The biography of the richest man in the world</h3>
                        <div class="product-rating">
                            <div class="product-rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="product-rating-count">(5,678)</span>
                        </div>
                        <div class="product-price">
                            <span class="current-price">৳699</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-add-to-cart">Add to Cart</button>
                            <button class="btn btn-quick-view"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>