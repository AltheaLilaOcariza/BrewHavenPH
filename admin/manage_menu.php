<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<?php 
    $title = "Manage Menu | BrewHaven Cafe PH";
    $extra_css = ['../assets/css/includes.css', '../assets/css/admin_manage_menu.css'];
    include '../includes/header.php';
    require '../backend/functions.php';

    $item = new Item();
    $item_list = $item->getAllItems();
    
    // Fetch distinct categories dynamically
    $categories = $item->getCategories();
    
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
        </div>
    
        <div class="main-grid">
    
            <!-- LEFT SECTION -->
            <div class="left-panel">
                <div class="panel-header">
                    <h2>Products</h2>
    
                    <div class="dropdown">
                        <select id="categoryFilter" class="input">
                            <option value="all">All</option>
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat ?>"><?= $cat ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                </div>
    
                <div class="product-scroll">
                    <div class="product-list">
                    <?php 
                    foreach ($item_list as $item) {
                    ?>
                        <!-- Repeated Product Card -->
                        <div class="product-card" 
                            data-id="<?= $item['item_id'] ?>"
                            data-name="<?= strtolower($item['name']) ?>" 
                            data-category="<?= strtolower($item['category']) ?>">
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
                <form action="../backend/crud.php" method="POST" enctype="multipart/form-data">
                    
                    <div class="panel-top">
                        <h2>Product Info</h2>
                        <input type="submit" name="addbtn" value="Add" class="btn add">
                        <input type="submit" name="delbtn" value="Delete" class="btn delete">
                        <input type="submit" name="savebtn" value="Save" class="btn save">
                    </div>

                    <input type="number" name="id" style="display: none;">
                    <label>Product Name</label>
                    <p class="required">*required</p>
                    <input type="text" class="input" name="product_name">
    
                    <div class="row">
                        <div>
                            <label>Price</label>
                            <p class="required">*required</p>
                            <input type="text" class="input small" name="price">
                        </div>
                        <div>
                            <label>Status</label>
                            <p class="required">*required</p>
                            <select class="input" name="status">
                                <option value="In Stock">In Stock</option>
                                <option value="Out of Stock">Out of Stock</option>
                            </select>
                        </div>
                    </div>
    
                    <label>Category</label>
                    <p class="required">*required</p>
                    <select class="input" name="category">
                        <option value="all">All</option>
                        <?php foreach($categories as $cat): ?>
                            <option value="<?= $cat ?>"><?= $cat ?></option>
                        <?php endforeach; ?>
                    </select>
    
                    <label>Product Description</label>
                    <textarea class="textarea" name="description"></textarea>
    
                    <label>Product Image</label>
                    <div class="image-wrapper">
                        <div class="image-box" id="productImage"></div>
                        <input type="file" name="image">
                    </div>

                </form>

            </div>
    
        </div>
    
    </div>
    
</div>

<?php include '../includes/manage_menu_alerts.php'; ?>

<?php include '../includes/footer.php'; ?>
