<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Assets/css/createProduct.css" />
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
    // Sqlite conn
    $databasePath = '../database/' . DATABASE_NAME . '.sqlite';
    $pdo = (new SQLiteConnection())->connect($databasePath);
    if ($pdo !== null) {
        $id = $_GET['id'];
        $Product = new Product($pdo);
        $item = $Product->whereId($id);
        if (count($item) < 1) {
            header("location: /index.php");
        } else {
            // get first item
            $item = $item[0];
        }
    } else {
        // Fail to connect
        header("location: /index.php");
    }
}

?>

<body>
    <!-- Navbar -->

    <!-- End Navbar -->

    <!-- Content -->
    <div class="content">
        <div class="wrapper">
            <h3 class="title">CHANGE STOCK DORAYAKI</h3>
            <form class="form" action="../Middlewares/changestock.php" method="POST" enctype="multipart/form-data">
                <div class="input-field">
                    <label for="price">Stock</label>
                    <input type="number" min='0' id="stock" name="stock" value="<?php echo $item['stock'] ?>" required>
                </div>

                <!-- <input type="hidden" id="id" name="id" value="<?php echo $id ?>"> -->

                <div class="input-field">
                    <input class="button" type="submit" id="submit" name="edit" value="Update">
                </div>

            </form>
        </div>
    </div>
    <!-- end content -->


    <!-- Footer -->

    <!-- End  Footer -->


</body>

</html>