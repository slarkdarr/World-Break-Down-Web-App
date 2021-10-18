<?php
include_once('../config.php');

if (isset($_COOKIE['message'])) {
    alert($_COOKIE['message']);
}

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
    setcookie('message', '', time() - 3600, '/');
}

session_start();
// Validate if logged in
if (isset($_SESSION['username'])) {
    header("location: /index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Assets/css/login.css">
    <link rel="stylesheet" href="../Assets/css/style.css">
</head>

<body class="page-1">
    <div class="container center ">
        <div class="card grid-container">
            <div class="card-left grid-item">
                <div class="logo">
                    <img src="../Assets/images/dorayaki.png" alt="" class="image">
                </div>
            </div>
            <div class="card-right grid-item">
                <div class="form">
                    <div class="head-form">
                        <h1>Login</h1>
                    </div>
                    <div class="form-input">
                        <form action="../Middlewares/login.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <div class="form-input">
                                    <input type="text" name="username" placeholder="username / email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="form-input">
                                    <input type="password" name="password" placeholder="password" required>
                                </div>
                            </div>
                            <div class="button-submit">
                                <button type="submit" name="login">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>