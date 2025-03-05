<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <?php require('inc/links.php') ?>
    <link rel="stylesheet" href="css/venues.css">
    <link rel="stylesheet" href="css/venue_details.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <?php
    if (!isset($_GET['id'])) {
        redirect('venues.php');
    }

    $data = filteration($_GET);

    $venue_res = select("SELECT * FROM `venues` WHERE `id` = ? AND `status` = ? AND `removed` = ?", [$data['id'], 1, 0], 'iii');

    if (mysqli_num_rows($venue_res) == 0) {
        redirect('venues.php');
    }

    $venue_data = mysqli_fetch_assoc($venue_res);
    ?>

    <div class="venue-section">

        <div class="venuedetails-container">
            <div class="venuedetails-card">
                <div class="venuedetails-img">

                    <?php
                    $venue_img = VENUES_IMG_PATH . "thumbnail.jpg";
                    $venue_q = mysqli_query($con, "SELECT * FROM `venue_images` WHERE `venue_id` = '$venue_data[id]'");

                    if (mysqli_num_rows($venue_q) > 0) {
                        while ($img_res = mysqli_fetch_assoc($venue_q)) {
                            echo "
                                <img src='" . VENUES_IMG_PATH . $img_res['image'] . "' alt='thumbnail'>
                                ";
                        }
                    } else {
                        echo "
                        <img src='$venue_img' alt='thumbnail'>";
                    }

                    ?>

                </div>
                <div class="venuedetails-item">
                    <?php

                    echo <<<name
                        <h4>$venue_data[name]</h4>
                    name;

                    echo <<<price
                            <p>Price: <span>Rs$venue_data[price]</span></p>
                        price;

                    echo <<<capacity
                            <p>Capacity: <span>Rs$venue_data[capacity]</span></p>
                        capacity;

                    echo <<<area
                            <p>Area: <span>Rs$venue_data[area]</span></p>
                        area;


                    ?>

                    <div>
                        <p>Features</p>

                        <?php
                        $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `venue_features` vfea ON f.id = vfea.features_id WHERE vfea.venue_id = '$venue_data[id]'");


                        $features_data = "";
                        while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                            $features_data .= "<span>$fea_row[name]</span>";
                        }

                        echo <<<features
                                <div class="service-row">
                                    $features_data
                                </div>
                            features;

                        ?>

                    </div>
                    <div>
                        <p>Services</p>
                        <?php
                        $serv_q = mysqli_query($con, "SELECT s.name FROM `services` s INNER JOIN `venue_services` vsec ON s.id = vsec.services_id WHERE vsec.venue_id = '$venue_data[id]'");

                        $services_data = "";

                        while ($serv_row = mysqli_fetch_assoc($serv_q)) {
                            $services_data .= "<span>$serv_row[name]</span>";
                        }

                        echo <<<services
                                <div class="service-row">
                                    $services_data
                                </div>
                            services;

                        ?>
                    </div>
                    <div class="btn-group">
                        <button class="full-btn">Book Now</button>
                    </div>
                </div>
            </div>

            <div class="venuedetails-description">
                <?php
                echo <<<description
                        <div class="venuedetails-description-item">
                            <p style="padding-bottom:5px;">Description: </p>
                            <span>$venue_data[description]</span>
                        </div>
                        description;

                ?>
            </div>

        </div>
    </div>



    <?php require('components/footer.php') ?>

</body>

</html>