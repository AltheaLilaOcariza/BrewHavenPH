<?php 
    $title = "Manage Menu | BrewHaven Cafe PH";
    $extra_css = ['../assets/css/includes.css', '../assets/css/admin_manage_menu.css'];
    include '../includes/header.php';
    require '../backend/functions.php';

    $item = new Item();
    $item_list = $item->getAllItems();
?>

<div class="container">
    <?php include '../includes/admin_nav.php'; ?>

    <div class="manage-menu-container">
    
        <h1 class="title">MENU</h1>
    
        <div class="top-buttons">
            <div class="search-box">
                <input type="text" placeholder="Search product...">
                <span class="search-icon">🔍</span>
            </div>
    
            <button class="btn add">Add</button>
            <button class="btn delete">Delete</button>
        </div>
    
        <div class="main-grid">
    
            <!-- LEFT SECTION -->
            <div class="left-panel">
                <div class="panel-header">
                    <h2>Products</h2>
    
                    <div class="dropdown">
                        <button class="dropdown-btn">Category ⮟</button>
                    </div>
                </div>
    
                <div class="product-scroll">
                    <div class="product-list">
                    <?php 
                    foreach ($item_list as $item) {
                    ?>
                        <!-- Repeated Product Card -->
                        <div class="product-card">
                            <div class="product-info">
                                <img src="<?= $item['image'] ?>" alt="Product Image">
                                <div>
                                    <p class="product-name"><?= $item['name'] ?></p>
                                    <p class="timestamps">
                                        Created | <?= $item['created_at'] ?><br>
                                        Edited | <?= $item['edited_at'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="product-price"><?= $item['price'] ?></div>
                        </div>
                    <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
    
            <!-- RIGHT SECTION -->
            <div class="right-panel">
                <div class="panel-top">
                    <h2>Product Info</h2>
                    <button class="btn save">Save</button>
                </div>
    
                <label>Product Name</label>
                <input type="text" class="input">
    
                <div class="row">
                    <div>
                        <label>Price</label>
                        <input type="text" class="input small">
                    </div>
                    <div>
                        <label>Status</label>
                        <select class="input">
                            <option>In Stock</option>
                            <option>Out of Stock</option>
                        </select>
                    </div>
                </div>
    
                <label>Category</label>
                <select class="input">
                    <option>None</option>
                </select>
    
                <input type="text" class="input" placeholder="Other">
    
                <label>Product Description</label>
                <textarea class="textarea"></textarea>
    
                <label>Product Image</label>                              
                <div class="image-wrapper">
                    <div class="image-box"></div>
                    <button class="btn delete ">Edit</button>
                </div>
    
            </div>
    
        </div>
    
    </div>
    
</div>

<?php include '../includes/footer.php'; ?>