<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <?php require('inc/links.php') ?>
    <link rel="stylesheet" href="css/venues.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="venue">
        <div class="venue-section">

            <div class="venue-container">

                <?php
                $venue_res = select("SELECT * FROM `venues` WHERE `status` = ? AND `removed` = ?", [1, 0], 'ii');

                while ($venue_data = mysqli_fetch_assoc($venue_res)) {

                    $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `venue_features` vfea ON f.id = vfea.features_id WHERE vfea.venue_id = '$venue_data[id]'");


                    $features_data = "";
                    while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                        $features_data .= "<p>$fea_row[name]</p>";
                    }


                    $serv_q = mysqli_query($con, "SELECT s.name FROM `services` s INNER JOIN `venue_services` vsec ON s.id = vsec.services_id WHERE vsec.venue_id = '$venue_data[id]'");

                    $services_data = "";

                    while ($serv_row = mysqli_fetch_assoc($serv_q)) {
                        $services_data .= "<p>$serv_row[name]</p>";
                    }

                    echo <<<data
                        <div class="venue-card">
                            <img src="images/rooms/IMG_42663.png" alt="">
                            <div class="venue-item">
                                <h4>$venue_data[name]</h4>
                                <p>Price: <span>Rs$venue_data[price]</span></p>
                                <p>Capacity: <span>$venue_data[capacity]</span></p>
                                <p>Area: <span>$venue_data[area] sq.ft</span></p>
                                <div>
                                    <p>Features</p>
                                    <div class="service-row">
                                        $features_data
                                    </div>
                                </div>
                                <div>
                                    <p>Services</p>
                                    <div class="service-row">
                                        $services_data
                                    </div>
                                </div>
                            </div>
                            <div class="btn-group">
                                <a class="btn">Book Now</a>
                                <a href="venue_details.php?id=$venue_data[id]" class="btn">View Details</a>
                            </div>
                        </div>
                    data;
                }

                ?>
                <!-- <div class="venue-card">
                    <img src="images/rooms/IMG_42663.png" alt="">
                    <div class="venue-item">
                        <h4>Sagarmatha Venue</h4>
                        <p>Price: <span>Rs 100000</span></p>
                        <p>Capacity: <span>1000</span></p>
                        <p>Area: <span>11000sq ft</span></p>
                        <div>
                            <p>Services</p>
                            <div class="service-row">
                                <p>DJ</p>
                                <p>Catering</p>
                                <p>Wifi</p>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button class="btn">Book Now</button>
                        <button class="btn">View Details</button>
                    </div>
                </div> -->
            </div>
        </div>

    </div>

    <?php require('components/footer.php') ?>

</body>

</html>