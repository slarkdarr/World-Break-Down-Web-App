<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Assets/css/stock.css" />
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/55c10e2ab9.js" crossorigin="anonymous"></script>

    <title>Jajan.id</title>
</head>

<?php

include_once('../config.php');
include_once('../database/SQLiteConnection.php');
include_once('../Model/Product.php');

// Validate logged in
include_once('../config.php');
session_start();
if (isset($_COOKIE['token']) && isset($_COOKIE['userLoggedIn'])) {
    if ((md5($_COOKIE['userLoggedIn'] . SECRET_WORD)) !== $_COOKIE['token'] || $_SESSION['role'] !== 'admin') {
        setcookie('message', 'Prohibited', time() + 3600, '/');
        header("location: /Views/Login.php");
    }
} else {
    // Destroy session
    session_unset();
    session_destroy();
    setcookie('message', 'Prohibited', time() + 3600, '/');
    header("location: /Views/Login.php");
}

// Validate id exists
if (!isset($_GET['id'])) {
    header("location: /index.php");
} else {
    $id = $_GET['id'];
}

?>

<body>
    <!-- Navbar -->

    <!-- End Navbar -->

    <!-- Content -->
    <div class="content">
        <p>Stock saat ini</p>
        <div id="stock" data-id="<?php echo $id ?>" class="stock">30</div>

        <form action="#" method="POST">
            <input id="available-stock" type="number" min=""> 
        </form>
    </div>
    <!-- end content -->


    <!-- Footer -->

    <!-- End  Footer -->

    <script type="text/javascript">
        function loadStock() {
            let stock = document.getElementById("stock");
            let id = stock.getAttribute('data-id');
            let avail = document.getElementById('available-stock');
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const data = JSON.parse(xhttp.responseText);
                    stock.innerHTML = data.stock;
                    avail.min = -data.stock;
                    console.log(-data.stock)
                }
            };
            xhttp.open("GET", "../Middlewares/stock.php?id=" + id, true);
            xhttp.send();
        }
        setInterval(loadStock, 5000);
    </script>

</body>

</html>