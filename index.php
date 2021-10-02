<?php
include_once('config.php');

session_start();

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
    unset($_SESSION['message']);
}
// Validate logged in
if (isset($_SESSION['username'])) {
    if (isset($_SESSION['message'])) {
        alert($_SESSION['message']);
    }
} else {
    $_SESSION['message'] = "Login to view Doraemon Ecommerce";
    header("location:" . URL . 'Views/Login.php');
}

?>

<body>
    <!-- Navbar -->
    <p>Halo</p>
    <!-- Content -->

    <!-- Footer -->

</body>

</html>