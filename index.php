<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <?php require('inc/links.php') ?>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="swiper-container">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/nature-1.jpg" />
                </div>
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/nature-2.jpg" />
                </div>
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/nature-3.jpg" />
                </div>
                <div class="swiper-slide">
                    <img src="https://swiperjs.com/demos/images/nature-4.jpg" />
                </div>
            </div>
        </div>
    </div>


    <!-- Availability Form -->
    <div class="availability-form">
        <h5>Check Booking Availability</h5>
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


    <!-- venues -->
    <div class="venue-section">
        <h5>Our Venues</h5>

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

                    <div class="btn-group">
                        <button class="btn">Book Now</button>
                        <button class="btn">View Details</button>
                    </div>
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

                    <div class="btn-group">
                        <button class="btn">Book Now</button>
                        <button class="btn">View Details</button>
                    </div>
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

                    <div class="btn-group">
                        <button class="btn">Book Now</button>
                        <button class="btn">View Details</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="more-btn-container">
            <a class="more-btn">MORE VENUES</a>
        </div>
    </div>

    <!-- Services -->
    <div class="service-section">
        <h5>Our Services</h5>

        <div class="service-container">
            <div class="service-card">
                <img src="images/facilities/IMG_96423.svg" alt="">
                <div class="service-item">
                    <h4>Free Hotspot & Wifi</h4>
                </div>
            </div>

            <div class="service-card">
                <img src="images/facilities/IMG_96423.svg" alt="">
                <div class="service-item">
                    <h4>Free Hotspot & Wifi</h4>
                </div>
            </div>

            <div class="service-card">
                <img src="images/facilities/IMG_96423.svg" alt="">
                <div class="service-item">
                    <h4>Free Hotspot & Wifi</h4>
                </div>
            </div>
        </div>
        <div class="more-btn-container">
            <a class="more-btn">MORE SERVICES</a>
        </div>
    </div>

    <?php require('components/footer.php') ?>


    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            effect: "fade",
        });
    </script>
</body>

</html>