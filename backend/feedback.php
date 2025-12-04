<?php
require 'functions.php';
$feedbackDAO = new FeedbackDAO();

if (isset($_POST['submit'])) {


    $subject = ($_POST['name']); 
    $message = trim($_POST['feedback']);  // Rename variable for clarity

    // Add feedback
    $success = $feedbackDAO->addFeedback($subject, $message);

     // Load SweetAlert
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    if ($success) {
        header("Location: ../pages/contact.php?status=success&action=sent");
        exit;
    } else {
        header("Location: ../pages/contact.php?status=error&action=sent");
        exit;
    }
    exit;
}

if (isset($_POST['delete'])){
    $id = $_POST['id'];

    if(!$id){
        header("Location: ../admin/feedbacks.php?status=error&action=deleted");
    }

    $success = $feedbackDAO->deleteFeedback($id);

     // Load SweetAlert
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    if ($success) {
        header("Location: ../admin/feedbacks.php?status=success&action=deleted");
        exit;
    } else {
        header("Location: ../admin/feedbacks.php?status=error&action=deleted");
        exit;
    }

}
?>
