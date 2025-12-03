<?php 
    $title = "Feedbacks | BrewHaven Cafe PH";
    $extra_css = ['../assets/css/includes.css', '../assets/css/feedback.css'];
    include '../includes/header.php';
    require '../backend/functions.php';

    $feedbackDAO = new FeedbackDAO();
    $allFeedbacks = $feedbackDAO->getAllFeedback();
?>


<div class="container">
    <?php include '../includes/admin_nav.php'; ?>

    <section class="main-content">
        <h1>Feedbacks</h1>
        <div class="line"></div>
        <?php
        foreach($allFeedbacks as $feedback){
        ?>
        <section class="feedback-container">
            <section class="right-panel">
                <h2><?= $feedback['subject'] ?></h2>
                <p class="feedback"><?= $feedback['message'] ?></p>
                <p class="date"><?= $feedback['created_at'] ?></p>
            </section>
            <section class="left-panel">
                <form action="../backend/feedback.php" method="POST">
                    <input hidden name="id" value=<?= $feedback['id'] ?>>
                    <button class="delete" name="delete" value="delete">Delete</button>
                </form>
            </section>
        </section>
        <?php
        }
        ?>
    </section>

</div>
<?php include '../includes/feedback_alerts.php'; ?>
<?php include '../includes/footer.php'; ?>