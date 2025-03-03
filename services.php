<?php
require_once('admin/inc/db_config.php');
require_once('admin/inc/uploadImage.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <?php require('inc/links.php') ?>
    <link rel="stylesheet" href="css/services.css">
</head>

<body>
    <?php require('components/navbar.php') ?>

    <div class="service-section">
        <h5>Our Services</h5>

        <div class="service-container">

            <?php
            $res = selectAll('services');
            $path = SERVICES_IMG_PATH;

            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data
                    <div class="service-card">
                        <img src="$path$row[icon]" alt="">
                        <div class="service-item">
                            <h4>$row[name]</h4>
                            <p>
                                $row[description]
                            </p>
                        </div>
                    </div>
                data;
            }
            ?>

        </div>

    </div>

    <?php require('components/footer.php') ?>

</body>

</html>