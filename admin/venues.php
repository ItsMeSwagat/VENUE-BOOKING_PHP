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
    <title>Admin Panel -- Venues</title>
    <?php require('../inc/links.php') ?>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/features.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="dashboard-container">
        <?php require('components/sidebar.php') ?>

        <section class="table-container">
            <h3>Venues</h3>
            <a href="add_venue.php" class="btn">Add Venue</a>
            <table>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Area</th>
                    <th>Capacity</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                    <th>Actions</th>

                </tr>

                <tbody id="venues-data">

                </tbody>

            </table>
        </section>
    </div>

    <script>
        window.onload = function() {
            get_all_venues();
        }

        function edit_details(id) {
            console.log(id);
        }

        function get_all_venues() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/venues_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById('venues-data').innerHTML = this.responseText;

            }
            xhr.send('get_all_venues');
        }

        function toggle_status(id, val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/venues_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("Status toggled!");
                    get_all_venues();
                }
            }
            xhr.send('toggle_status=' + id + '&value=' + val);
        }

        function rem_venue(venue_id) {
            if (confirm("Are you sure you want to delete this venue?")) {
                let data = new FormData();
                data.append('venue_id', venue_id);
                data.append('rem_venue', '');

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/venues_crud.php", true);

                xhr.onload = function() {
                    console.log(this.responseText)
                    if (this.responseText == 1) {
                        alert("Venue Removed!");
                        get_all_venues();
                    } else {
                        alert("Error, Room Removal Failed!");
                    }
                }
                xhr.send(data);
            }
        }
    </script>


</body>

</html>