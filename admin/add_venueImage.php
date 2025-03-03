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
    <title>Admin Panel -- Add Venue Image</title>
    <?php require('../inc/links.php') ?>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/features.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="add-container">
        <h2 class="model_title"></h2>
        <form id="add_venueImage_form" method="POST">

            <div>
                <label>Add Image:</label>
                <input type="file" accept=".jpg, .jpeg, .png, .webp" name="image" required>
            </div>

            <button type="submit" class="cancel-btn">Add Image</button>
            <a href="venues.php" class="cancel-btn">Back</a>
            <input type="hidden" name="venue_id">
        </form>
    </div>

    <section class="table-container">
        <table>
            <tr>
                <th>Image</th>
                <th>Thumb</th>
                <th>Delete</th>
            </tr>

            <tbody id="venue-image-data">

            </tbody>

        </table>
    </section>

    <script>
        window.onload = function() {
            get_venueDetails();
        }

        let venue_id = getUrlParameter('id');
        let venue_name = getUrlParameter('name');
        console.log(venue_id);
        console.log(venue_name);

        function getUrlParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        function get_venueDetails() {
            document.querySelector(".model_title").innerHTML = venue_name;
            add_venueImage_form.elements['venue_id'].value = venue_id;

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/venues_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById('venue-image-data').innerHTML = this.responseText;
            }
            xhr.send('get_venue_images=' + venue_id);
        }

        let add_venueImage_form = document.getElementById('add_venueImage_form');

        add_venueImage_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_image();
        })

        function add_image() {
            let data = new FormData();
            data.append('image', add_venueImage_form.elements['image'].files[0]);
            data.append('venue_id', add_venueImage_form.elements['venue_id'].value);
            data.append('add_image', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/venues_crud.php", true);


            xhr.onload = function() {
                console.log(this.responseText);
                if (this.responseText == "inv_img") {
                    alert("Error, Only JPG & PNG images are allowed");
                } else if (this.responseText == 'inv_size') {
                    alert("Error, Image should be less than 2MB");
                } else if (this.responseText == 'upd_failed') {
                    alert("Error, Image upload failed. Server Down");
                } else {
                    alert("New Image Added!");
                    add_venueImage_form.reset();
                    get_venueDetails();
                }
            }

            xhr.send(data);
        }

        function rem_venueImage(img_id, venue_id) {
            let data = new FormData();
            data.append('image_id', img_id);
            data.append('venue_id', venue_id);
            data.append('rem_venueImage', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/venues_crud.php", true);


            xhr.onload = function() {
                console.log(this.responseText);
                if (this.responseText == 1) {
                    alert("Image Removed!");
                    get_venueDetails();
                } else {
                    alert("!Error! Image removal Error");
                }
            }

            xhr.send(data);
        }
    </script>

</body>

</html>