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
    <title>Admin Panel -- Service</title>
    <?php require('../inc/links.php') ?>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/features.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="dashboard-container">
        <?php require('components/sidebar.php') ?>

        <section class="table-container">
            <h3>Services</h3>
            <a href="add_service.php" class="btn">Add Service</a>
            <table>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Description</th>
                    <th>Actions</th>

                </tr>

                <tbody id="services-data">

                </tbody>

            </table>
        </section>
    </div>

    <script>
        window.onload = function() {
            get_services();
        }

        function get_services() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/services_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById('services-data').innerHTML = this.responseText;
            }
            xhr.send('get_services');
        }

        function rem_service(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/services_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("service Deleted!");
                    get_services();
                } else if (this.responseText == 'venue_added') {
                    alert("Error,service added in Venue!");
                } else {
                    alert("Error, Server Down");
                }
            }
            xhr.send('rem_service=' + val);
        }
    </script>


</body>

</html>