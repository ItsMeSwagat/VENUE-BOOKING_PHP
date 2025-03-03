<?php

session_start();
require_once('inc/db_config.php');
require_once('inc/essentials.php');


if ((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
    redirect('dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require('../inc/links.php') ?>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <div class="form-box" id="login-form">
            <form action="" method="post">
                <h2>Admin Login</h2>
                <input type="text" name="admin_name" placeholder="Admin Name" required>
                <input type="password" name="admin_password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['login'])) {
        $frm_data = filteration($_POST);

        $query = "SELECT * FROM `admin_credentials` WHERE `admin_name`=? AND `admin_password`=?";
        $values = [$frm_data['admin_name'], $frm_data['admin_password']];

        $res = select($query, $values, "ss");

        if ($res->num_rows == 1) {
            $row = $res->fetch_assoc();

            $_SESSION['adminLogin'] = true;
            $_SESSION['adminId'] = $row['sr_no'];
            redirect('dashboard.php');
        } else {
            alertMsg("Login Failed -- Invalid Credentials");
        }
    }
    ?>

</body>

</html>