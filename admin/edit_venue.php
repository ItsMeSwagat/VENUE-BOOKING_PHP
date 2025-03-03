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
    <title>Admin Panel -- Edit Venue</title>
    <?php require('../inc/links.php') ?>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/venues.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="add-container">
        <h2>Edit Venue</h2>
        <form id="editVenue_form" method="POST">
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
                <input type="hidden" name="venue_id">
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
                <button type="submit" class="cancel-btn">Edit Venue</button>
                <a href="venues.php" class="cancel-btn">Back</a>
            </div>
        </form>
    </div>

    <script>
        window.onload = function() {
            getEditDetails();
        }

        let venue_id = getUrlParameter('id');
        console.log(venue_id);

        function getUrlParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }



        let editVenue_form = document.getElementById('editVenue_form');
        editVenue_form.addEventListener('submit', function(e) {
            e.preventDefault();
            edit_venue();
        })

        function getEditDetails() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/venues_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');


            xhr.onload = function() {

                let data = JSON.parse(this.responseText);
                editVenue_form.elements['venue_name'].value = data.venuedata.name;
                editVenue_form.elements['venue_area'].value = data.venuedata.area;
                editVenue_form.elements['venue_price'].value = data.venuedata.price;
                editVenue_form.elements['venue_quantity'].value = data.venuedata.quantity;
                editVenue_form.elements['venue_capacity'].value = data.venuedata.capacity;
                editVenue_form.elements['venue_description'].value = data.venuedata.description;
                editVenue_form.elements['venue_id'].value = data.venuedata.id;
                console.log(data);
                editVenue_form.elements['features'].forEach(el => {
                    if (data.features.includes(Number(el.value))) {
                        el.checked = true;
                    }
                })

                editVenue_form.elements['services'].forEach(el => {
                    if (data.services.includes(Number(el.value))) {
                        el.checked = true;
                    }
                })

            }

            xhr.send("get_venue=" + venue_id);
        }

        function edit_venue() {
            let data = new FormData();
            data.append('venue_id', editVenue_form.elements['venue_id'].value);
            data.append('name', editVenue_form.elements['venue_name'].value);
            data.append('area', editVenue_form.elements['venue_area'].value);
            data.append('price', editVenue_form.elements['venue_price'].value);
            data.append('quantity', editVenue_form.elements['venue_quantity'].value);
            data.append('capacity', editVenue_form.elements['venue_capacity'].value);
            data.append('description', editVenue_form.elements['venue_description'].value);
            data.append('edit_venue', '');

            let features = [];

            editVenue_form.elements['features'].forEach(el => {
                if (el.checked) {
                    features.push(el.value);
                }
            });

            let services = [];

            editVenue_form.elements['services'].forEach(el => {
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
                    alert("Venue Edited!");
                    editVenue_form.reset();
                    get_all_venues();
                } else {
                    alert("Error! Server Down!")
                }
            }

            xhr.send(data);
        }
    </script>

</body>

</html>