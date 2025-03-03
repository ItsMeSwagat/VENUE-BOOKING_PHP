<?php
require_once('inc/essentials.php');
require_once('inc/scripts.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel -- Dashboard</title>
    <?php require('../inc/links.php') ?>
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="dashboard-container">
        <?php require('components/sidebar.php') ?>
    </div>


</body>

</html>