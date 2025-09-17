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
    .top-sort-list{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px auto;
    }
    @media (max-width: 768px) {
        .top-sort-list{
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }
    .sort-list{
        max-width: 300px;
    }
    .sort-list select{
        width: 100%;
        display: block;
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: var(--bs-body-color);
        background-color: var(--bs-body-bg);
        background-clip: padding-box;
        border: var(--bs-border-width) solid var(--bs-border-color);
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: var(--bs-border-radius);
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
</style>
<?php

function getName($id){
    global $conn;
    $sql = "SELECT name FROM category_product WHERE id='".mysqli_real_escape_string($conn, $id)."'";
    $result = mysqli_query($conn, $sql);
    if($row = mysqli_fetch_assoc($result)){
        return $row['name'];
    }
    return 'All Products';
}
?>
<section id="product" class="section product-section">
    <div class="container">
        <div class="top-sort-list">
            <h2 class="section-title"><?= 
                isset($_GET['name']) ? $_GET['name'] : (isset($_GET['category']) ? getName($_GET['category']) : 'All Products')
            ?></h2>
            <div class="sort-list">
                <form action="" method="get" id="categoryForm">
                    <!-- //?products&category=<?= $row['id'] ?>&name=<?= str_replace(' ', '+', $row['name']) ?> -->
                    <select name="category" id="categorySelect" onchange="document.getElementById('categoryForm').submit()">
                        <?php
                            $sql = "SELECT * FROM category_product";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $selected = (isset($_GET['category']) && $_GET['category'] == $row['id']) ? 'selected' : '';
                                echo "<option value='".$row['id']."' $selected>".$row['name']."</option>";
                            }
                        ?>
                    </select>
                    <input type="hidden" name="products" value="0">
                </form>
            </div>
            <div class="sort-list">
                <form action="" method="get" id="priceForm">
                    <input type="hidden" name="products" value="0">
                    <?php if(isset($_GET['category'])){ ?>
                        <input type="hidden" name="category" value="<?= isset($_GET['category']) ? $_GET['category'] : '' ?>">
                        <input type="hidden" name="name" value="<?= isset($_GET['name']) ? $_GET['name'] : '' ?>">
                    <?php } ?>
                    
                    <select name="price" id="categorySelect" onchange="document.getElementById('priceForm').submit()">
                        <option disabled <?= isset($_GET['price']) ? "" : "selected"?>>Random Sort Price</option>
                        <option value='ASC' <?= isset($_GET['price']) && $_GET['price'] == "ASC" ? "selected" : "" ?>>Price low to high</option>
                        <option value='DESC' <?= isset($_GET['price']) && $_GET['price'] == "DESC" ? "selected" : "" ?>>Price high to low</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="row">
            <?php 
            $sql = "SELECT * FROM product";

            if(isset($_GET['price'])){
                $sql .= " ORDER BY price ".$_GET['price'];
            }

            if(isset($_GET['category'])){
                $sql .= " WHERE type='".mysqli_real_escape_string($conn, $_GET['category'])."'";
            }

            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){ ?>
            <div class="col-xl-3 col-lg-4 col-6">
                <div class="product-card">
                    <div class="product-img-container">
                        <span class="product-badge"><?= $row['status']; ?></span>
                        <!-- <div class="product-wishlist">
                            <i class="far fa-heart"></i>
                        </div> -->
                        <img src="admin/upload/<?= $row['img']; ?>" class="product-img" alt="<?= $row['name']; ?>">
                    </div>
                    <div class="product-body">
                        <span class="product-category">
                            <?php
                                $sql = "SELECT name FROM category_product WHERE id='".$row['type']."'";
                                $category = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                                echo $category['name'];
                            ?>
                        </span>
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
            ?>
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