<?php

session_start();

$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();



function isActiveForm($formName, $activeForm)
{
    return $formName === $activeForm ? 'active' : '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php require('inc/links.php') ?>
    <link rel="stylesheet" href="css/loginRegister.css">
</head>

<body>

    <div class="container">
        <div class="form-box <?= isActiveForm('login', $activeForm) ?>" id="login-form">
            <form action="login_register.php" method="post">
                <h2>Login</h2>
              
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account? <a onclick="showForm('register-form')" href="#">Register Now</a></p>
            </form>
        </div>

        <div class="form-box <?= isActiveForm('register', $activeForm) ?>" id="register-form">
            <form action="login_register.php" method="post">
                <h2>Register</h2>
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="number" name="number" placeholder="Phone Number">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
                <button type="submit" name="register">Register</button>
                <p>Already have an account? <a onclick="showForm('login-form')" href="loginRegister.php">Login Now</a></p>
            </form>
        </div>
    </div>

    <script src="script.js"></script>

</body>

</html>