<?php
require('inc/essentials.php');
require_once('inc/scripts.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel -- Feature</title>
    <?php require('../inc/links.php') ?>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/features.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="dashboard-container">
        <?php require('components/sidebar.php') ?>

        <section class="table-container">
            <h3>Features</h3>
            <a href="add_feature.php" class="btn">Add Feature</a>
            <table>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>

                </tr>

                <tbody id="features-data">

                </tbody>

            </table>
        </section>
    </div>

    <script>
        window.onload = function() {
            get_features();
        }

        function get_features() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById('features-data').innerHTML = this.responseText;
            }
            xhr.send('get_features');
        }

        function rem_feature(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("Feature Deleted!");
                    get_features();
                } else if (this.responseText == 'venue_added') {
                    alert("Error,Feature added in Venue!");
                } else {
                    alert("Error, Server Down");
                }
            }
            xhr.send('rem_feature=' + val);
        }
    </script>


</body>

</html>