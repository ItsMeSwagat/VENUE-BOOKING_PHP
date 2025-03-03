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
    <title>Admin Panel -- Add Feature</title>
    <?php require('../inc/links.php') ?>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/features.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="add-container">
        <h2>Add New Feature</h2>
        <form id="addFeature_form" method="POST">
            <label>Service Name:</label>
            <input type="text" name="feature_name" required>
            <button type="submit" class="cancel-btn">Add Feature</button>
            <a href="features.php" class="cancel-btn">Back</a>
        </form>
    </div>

    <script>
        let addFeature_form = document.getElementById('addFeature_form');
        addFeature_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_feature();
        })

        function add_feature() {
            let data = new FormData();
            data.append('name', addFeature_form.elements['feature_name'].value);
            data.append('add_feature', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_crud.php", true);


            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("New Feature added!");
                    addFeature_form.reset();
                    get_features();
                } else {
                    alert("Error, Server Down");
                }
            }

            xhr.send(data);
        }
    </script>

</body>

</html>