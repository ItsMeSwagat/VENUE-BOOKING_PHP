<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <?php require('inc/links.php') ?>
    <link rel="stylesheet" href="css/contact.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="header-container">
        <div class="bg-dark"></div>
        <img src="images/bgimg.jpg" alt="bgimage">
        <h1>Contact Us</h1>
    </div>

    <div class="contact-container">
        <div class="contact-card">
            <img src="images/contactimg.jpg" alt="contactimg">
            <div class="contact-info">
                <h2>Contact Us</h2>
                <p>+977 974-689-9082</p>
                <p>+977 980-096-2010</p>
            </div>
        </div>

        <div class="contact-card">
            <img src="images/contact.jpg" alt="contactimg">
            <div class="contact-info">
                <h2>Mail Us</h2>
                <p>info@venuemanagement.com</p>
                <p>venuemanagement@gmail.com</p>
            </div>
        </div>

        <div class="contact-card">
            <img src="images/headoffice.jpg" alt="contactimg">
            <div class="contact-info">
                <h2>Head Office</h2>
                <p>Venue Management, Biratnagar,2nd Floor</p>
                <p>Devkota Chowk, Biratnagar</p>
                <p>Building No. 73</p>
            </div>
        </div>
    </div>

    <?php require('components/footer.php') ?>
</body>

</html>