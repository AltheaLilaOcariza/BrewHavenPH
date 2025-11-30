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

    // FAIL if ID is not empty (because Add should not edit)
    if (!empty($id)) {
        header("Location: ../admin/manage_menu.php?status=error&action=add&reason=id_exists");
        exit;
    }

    // FAIL if name, price, or category is empty
    if (empty($name) || empty($price) || empty($category)) {
        header("Location: ../admin/manage_menu.php?status=error&action=add&reason=empty_fields");
        exit;
    }

    // FAIL if price is not a number
    if (!is_numeric($price)) {
        header("Location: ../admin/manage_menu.php?status=error&action=add&reason=invalid_price");
        exit;
    }

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
    $success = $item->create($name, $desc, $price, $image, $category, $status);

     // Load SweetAlert
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    if ($success) {
        header("Location: ../admin/manage_menu.php?status=success&action=add");
        exit;
    } else {
        header("Location: ../admin/manage_menu.php?status=error&action=add");
        exit;
    }
    exit;
}

if (isset($_POST['savebtn'])) {
    $id = $_POST['id'];
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $category = $_POST['category'];
    $desc = $_POST['description'];

    // FAIL if ID is not empty (because Add should not edit)
    if (empty($id)) {
        header("Location: ../admin/manage_menu.php?status=error&action=edit&reason=id_empty");
        exit;
    }

    // FAIL if name, price, or category is empty
    if (empty($name) || empty($price) || empty($category)) {
        header("Location: ../admin/manage_menu.php?status=error&action=add&reason=empty_fields");
        exit;
    }

    // FAIL if price is not a number
    if (!is_numeric($price)) {
        header("Location: ../admin/manage_menu.php?status=error&action=add&reason=invalid_price");
        exit;
    }

    $file_name = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];

    $image = '../assets/img/products/'.$file_name;

    $selected = $item->getItemById($id);
    $old_image = $selected['image'];

    if (!empty($file_name)) {
        // Move uploaded file
        $folder = '../assets/img/products/' . $file_name;
        move_uploaded_file($temp_name, $folder);
        $image = '../assets/img/products/' . $file_name;
    } else {
        // Keep the old image if no new file is uploaded
        $image = $old_image;
    }

    // Update the item in the database
    $success = $item->update($id, $name, $desc, $price, $image, $category, $status);

     // Load SweetAlert
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    if ($success) {
        header("Location: ../admin/manage_menu.php?status=success&action=edit");
        exit;
    } else {
        header("Location: ../admin/manage_menu.php?status=error&action=edit");
        exit;
    }

    exit;
}

if (isset($_POST['delbtn'])) {
    $id = $_POST['id'];

    if (empty($id)) {
        header("Location: ../admin/manage_menu.php?status=error&action=delete&reason=id_empty");
        exit;
    }

    // Update the item in the database
    $success = $item->delete($id);

     // Load SweetAlert
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    if ($success) {
        header("Location: ../admin/manage_menu.php?status=success&action=delete");
        exit;
    } else {
        header("Location: ../admin/manage_menu.php?status=error&action=delete");
        exit;
    }

    exit;
}

?>
