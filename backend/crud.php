<?php
require 'functions.php';
$item = new Item();

if (isset($_POST['addbtn'])) {
    $id = $_POST['id'];
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $category = $_POST['category'];
    $desc = $_POST['description'];

    $file_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];

    $image = '../assets/img/products/'.$file_name;

    if (!empty($file_name)) {
        // Move uploaded file
        $folder = '../assets/img/products/' . $file_name;
        move_uploaded_file($temp_name, $folder);
    } else {
        // Keep the old image if no new file is uploaded
        $image = '../assets/img/products/placeholder.png';
    }

    // Update the item in the database
    $item->create($name, $desc, $price, $image, $category, $status);
}

if (isset($_POST['savebtn'])) {
    $id = $_POST['id'];
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $category = $_POST['category'];
    $desc = $_POST['description'];

    $file_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];

    $image = '../assets/img/products/'.$file_name;

    $selected = $item->getItemById($id);
    $old_image = $selected['image'];

    if (!empty($file_name)) {
        // Move uploaded file
        $folder = '../assets/img/products/' . $file_name;
        move_uploaded_file($temp_name, $folder);
    } else {
        // Keep the old image if no new file is uploaded
        $file_name = $old_image;
        $image = $old_image;
    }

    // Update the item in the database
    $item->update($id, $name, $desc, $price, $image, $category, $status);
}

if (isset($_POST['delbtn'])) {
    $id = $_POST['id'];
    
    // Update the item in the database
    $item->delete($id);
}
?>
