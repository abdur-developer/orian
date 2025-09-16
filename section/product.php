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
        padding: 10px;
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
        padding: 3px 8px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 500;
        z-index: 1;
    }
    
    /* .product-wishlist {
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
    } */
    
    .product-body {
        padding: 12px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .product-category {
        color: var(--text-light);
        font-size: 10px;
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
        font-size: 12px;
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
        gap: 3px;
    }
    
    .current-price {
        font-weight: 700;
        font-size: 14px;
        color: var(--primary-color);
    }
    
    .original-price {
        font-size: 12px;
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
            font-size: 12px;
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

<section id="product" class="section product-section" style="padding: 40px 0;">
    <style>
        .cate-title{
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            color: var(--text-dark);
            padding-left: 20px;
        }
        .categories-container {
            width: 100%;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .ct-item {
            background: white;
            border-radius: 12px;
            padding: 15px 10px;
            margin: 5px;
            text-align: center;
            font-weight: 400;
            font-size: 16px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.05);
            color: #5a5a5a;
            display: inline-block;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        #see-more{
            background: #5a5a5a;
            display: none;
            color: white;
        }

        @media screen and (max-width: 576px) {
            .ct-item {
                padding: 5px;
                margin: 2px;
                font-size: 12px;
                display: none;
            }
            .ct-item:nth-child(-n+5) {
                display: inline-block;
            }
            .categories-container{
                padding: 15px 10px;
                margin-bottom: 15px;
                overflow: hidden;
            }
            #see-more{
                display: inline-block;
            }
        }
        .my-product>* {
            margin: 0;
            padding: 0;
        }
    </style>
    <h2 class="cate-title">Categories</h2>
    <div class="categories-container">
        <?php
            $sql = "SELECT * FROM category_product";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){ ?>
                <a href="?products&category=<?= $row['id'] ?>&name=<?= str_replace(' ', '+', $row['name']) ?>" class="ct-item"><?= $row['name'] ?></a>
                <?php }
        ?>
        <span class="ct-item" id="see-more">See more</span>
        <script>
            const btn = document.getElementById('see-more');

            btn.addEventListener('click', function () {
                document.querySelectorAll('.ct-item').forEach(item => {
                    item.style.display = 'inline-block';
                });
                btn.style.display = 'none';
            });
        </script>
    </div>
    <div class="container">
        <h2 class="section-title">Our Products</h2>
        
        <div class="row my-product">
            <?php 
            $sql = "SELECT * FROM product LIMIT 8";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){ ?>
            <div class="col-xl-3 col-lg-4 col-6" style="border: solid 0.1px #bcbcbc25;">
                <div class="product-card">
                    <div class="product-img-container">
                        <span class="product-badge"><?= $row['status']; ?></span>
                        <!-- <div class="product-wishlist">
                            <i class="far fa-heart"></i>
                        </div> -->
                        <img src="admin/upload/<?= $row['img']; ?>" class="product-img" alt="<?= $row['name']; ?>">
                    </div>
                    <div class="product-body">
                        <span class="product-category"><?php
                         $sql = "SELECT name FROM category_product WHERE id='".$row['type']."'";
                         $category = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                         echo $category['name'];
                         ?></span>
                        <h3 class="product-name"><?= $row['name']; ?></h3>
                        <div class="product-rating">
                            <div class="product-rating-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <span class="product-rating-count">(<?= $row['rating_count']; ?>)</span>
                        </div>
                        <div class="product-price">
                            <span class="current-price">৳<?= $row['price']; ?></span>
                            <span class="original-price">৳<?= $row['old_price']; ?></span>
                            <span class="discount"><?= getPercent($row['old_price'], $row['price']); ?> off</span>
                        </div>
                        <div class="product-actions">
                            <button class="btn btn-add-to-cart" onclick="addToCart('<?= encryptSt($row['id']) ?>', '<?=encryptSt($row['price'])?>')">Add to Cart</button>
                            <button class="btn btn-quick-view" onclick="viewProduct('<?= encryptSt($row['id']) ?>')"><i class="fas fa-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
                function getPercent($oldPrice, $currentPrice) {
                    if ($oldPrice == 0) return '0%';
                    return round((($oldPrice - $currentPrice) / $oldPrice) * 100) . '%';
                }
            ?>
        </div>
        <div class="view-all-btn">
            <a href="?products" class="btn btn-primary">
                সব প্রোডাক্ট দেখুন <i class="fas fa-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
    <script>
        function addToCart(id, nani){
            window.location.href = "cart/add.php?thanks=" + id+ "&nani="+nani+"&type=product";
        }
        function viewProduct(id){
            window.location.href = "?product-details=" + id;
        }
    </script>
</section>