<?php

$usersFile = "user.txt";

$message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin_username = "12345";
    $admin_password = "12345";

    $entered_username = $_POST['username'];
    $entered_password = $_POST['password'];

    if ($entered_username === $admin_username && $entered_password === $admin_password) {
        $key = $_POST['key'];
        $expiration_time = $_POST['expiration_time'];

        $userData = array(
            'key' => $key,
            'expiration_time' => $expiration_time
        );

        $userDataJson = json_encode($userData);
        $file = fopen($usersFile, 'a');
        fwrite($file, $userDataJson . PHP_EOL);
        fclose($file);

        $message = "Key has been successfully added!";
    } else {
        $error_message = "Error: Admin authentication failed. Please check the username and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Key Creation Web</title>
    <!-- Add the AdminLTE 3 CSS and other stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Top navigation bar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <!-- Center the form using Bootstrap's grid system -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <!-- Display success or error message -->
                    <?php
                    if (!empty($message)) {
                        echo '<div class="alert alert-success">' . $message . '</div>';
                    }
                    if (!empty($error_message)) {
                        echo '<div class="alert alert-danger">' . $error_message . '</div>';
                    }
                    ?>
                    <!-- HTML form to enter admin username, password, key, and expiration time -->
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Admin Username:</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Admin Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="key">Key to Create:</label>
                            <input type="text" name="key" id="key" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="expiration_time">Expiration Time:</label>
                            <input type="datetime-local" name="expiration_time" id="expiration_time" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Add the AdminLTE 3 and other JavaScript libraries -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    </div>
</body>
</html>
