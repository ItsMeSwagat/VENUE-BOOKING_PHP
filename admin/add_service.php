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
    <title>Admin Panel -- Add Service</title>
    <?php require('../inc/links.php') ?>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/features.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="add-container">
        <h2>Add New Service</h2>
        <form id="addService_form" method="POST">
            <div>
                <label>Service Name:</label>
                <input type="text" name="service_name" required>
            </div>

            <div>
                <label>Icon:</label>
                <input type="file" accept=".svg" name="service_icon" required>
            </div>

            <div>
                <label>Description:</label>
                <textarea name="service_description" id=""></textarea>
            </div>

            <button type="submit" class="cancel-btn">Add Service</button>
            <a href="services.php" class="cancel-btn">Back</a>
        </form>
    </div>

    <script>
        let addService_form = document.getElementById('addService_form');
        addService_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_service();
        })

        function add_service() {
            let data = new FormData();
            data.append('name', addService_form.elements['service_name'].value);
            data.append('icon', addService_form.elements['service_icon'].files[0]);
            data.append('description', addService_form.elements['service_description'].value);
            data.append('add_service', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/services_crud.php", true);


            xhr.onload = function() {
                console.log(this.responseText);
                if (this.responseText == "inv_img") {
                    alert("Error, Only SVG images are allowed");
                } else if (this.responseText == 'inv_size') {
                    alert("Error, Image should be less than 2MB");
                } else if (this.responseText == 'upd_failed') {
                    alert("Error, Image upload failed. Server Down");
                } else {
                    alert("New Service Added!");
                    addService_form.reset();
                }
            }

            xhr.send(data);
        }
    </script>

</body>

</html>