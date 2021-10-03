<?php
include_once('config.php');

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
    setcookie('message', '', time() - 3600, '/');
}
// Validate logged in

if (isset($_COOKIE['username'])) {
    if (isset($_COOKIE['message'])) {
        alert($_COOKIE['message']);
    }
} else {
    setcookie('message', 'Login to view Doraemon Ecommerce', time()+3600*24, '/');
    header("location:" . URL . 'Views/Login.php');
}

?>

<body>
    <!-- Navbar -->
    <p>Halo</p>
    <!-- Content -->
    <p><?php echo $_COOKIE['username'] ?></p>
    <p><?php echo $_COOKIE['message'] ?></p>
    <!-- Footer -->

</body>

</html>