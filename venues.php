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

        <div class="availability-form">
            <h5>Check Availability</h5>
            <form action="">
                <div class="form-item">
                    <label for="">Start Date:</label>
                    <input type="date" required>
                </div>
                <div class='form-item'>
                    <label for="">Start Date:</label>
                    <input type="date" required>
                </div>

                <div>
                    <button class="availability-btn">Check Availability</button>
                </div>

            </form>

        </div>

        <div class="venue-section">

            <div class="venue-container">
                <div class="venue-card">
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
                </div>

                <div class="venue-card">
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
                </div>


                <div class="venue-card">
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
                </div>

            </div>
        </div>

    </div>

    <?php require('components/footer.php') ?>

</body>

</html>