<?php
require_once('inc/essentials.php');
require_once('inc/db_config.php');
require_once('inc/scripts.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel -- Add Venue</title>
    <?php require('../inc/links.php') ?>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/venues.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="add-container">
        <h2>Add New Venue</h2>
        <form id="addVenue_form" method="POST">
            <div class="form-grid">
                <div>
                    <label>Name:</label>
                    <input type="text" name="venue_name" required>
                </div>

                <div>
                    <label>Area:</label>
                    <input type="number" name="venue_area" required>
                </div>

                <div>
                    <label>Price:</label>
                    <input type="number" name="venue_price" required>
                </div>

                <div>
                    <label>Quantity:</label>
                    <input type="number" name="venue_quantity" required>
                </div>

                <div>
                    <label>Capacity:</label>
                    <input type="number" name="venue_capacity" required>
                </div>
                <!-- <div>
                    <label>Icon:</label>
                    <input type="file" accept=".svg" name="venue_icon" required>
                </div> -->
            </div>

            <div class="form-item">
                <label>Features:</label>

                <div class="feature-div">
                    <?php
                    $res = selectAll('features');
                    while ($opt = mysqli_fetch_assoc($res)) {
                        echo "
                            <div class='feature-item'>
                                <label>
                                    <input type='checkbox' value='$opt[id]' name='features' />
                                    <p>$opt[name]</p>
                                </label>
                            </div>
                        ";
                    }
                    ?>
                </div>
            </div>

            <div class="form-item">
                <label>Services:</label>

                <div class="feature-div">
                    <?php
                    $res = selectAll('services');
                    while ($opt = mysqli_fetch_assoc($res)) {
                        echo "
                            <div class='feature-item'>
                                <label>
                                    <input type='checkbox' value='$opt[id]' name='services' />
                                    <p>$opt[name]</p>
                                </label>
                            </div>
                        ";
                    }
                    ?>
                </div>
            </div>

            <div>
                <label>Description:</label>
                <textarea name="venue_description" id=""></textarea>
            </div>

            <div>
                <button type="submit" class="cancel-btn">Add Venue</button>
                <a href="venues.php" class="cancel-btn">Back</a>
            </div>
        </form>
    </div>

    <script>
        let addVenue_form = document.getElementById('addVenue_form');
        addVenue_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_venue();
        })

        function add_venue() {
            let data = new FormData();
            data.append('name', addVenue_form.elements['venue_name'].value);
            data.append('area', addVenue_form.elements['venue_area'].value);
            data.append('price', addVenue_form.elements['venue_price'].value);
            data.append('quantity', addVenue_form.elements['venue_quantity'].value);
            data.append('capacity', addVenue_form.elements['venue_capacity'].value);
            data.append('description', addVenue_form.elements['venue_description'].value);
            data.append('add_venue', '');

            let features = [];

            addVenue_form.elements['features'].forEach(el => {
                if (el.checked) {
                    features.push(el.value);
                }
            });

            let services = [];

            addVenue_form.elements['services'].forEach(el => {
                if (el.checked) {
                    services.push(el.value);
                }
            });

            console.log(features, services);

            data.append('features', JSON.stringify(features));
            data.append('services', JSON.stringify(services));

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/venues_crud.php", true);


            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("New Venue Added");
                    addVenue_form.reset();
                } else {
                    alert("Error! Server Down");
                }
            }

            xhr.send(data);
        }
    </script>

</body>

</html>