<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../Assets/css/detail.css">
    <link href="//db.onlinewebfonts.com/c/4a47df713b67c858644e569c4977de19?family=Dorayaki" rel="stylesheet" type="text/css" />
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/55c10e2ab9.js" crossorigin="anonymous"></script>

    <title>Jajan.id</title>
</head>

<?php
include_once('../config.php');
include_once('../database/SQLiteConnection.php');
include_once('../Model/Product.php');

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
    setcookie('message', '', time() - 3600, '/');
}
// Validate logged in
session_start();
if (isset($_COOKIE['token']) && isset($_COOKIE['userLoggedIn'])) {
    if ((md5($_COOKIE['userLoggedIn'] . SECRET_WORD)) === $_COOKIE['token']) {
        if (isset($_COOKIE['message'])) {
            alert($_COOKIE['message']);
        }
        $role = $_SESSION['role'];
    }
} else {
    // Destroy session
    session_unset();
    session_destroy();
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
    <?php include '../partials/navbar.php'; ?>
    <!-- End navbar -->

    <!-- Content -->
    <div class="content">
        <div class="detail-wrapper">
            <div class="detail-left">
                <div class="detail-img-wrapper">
                    <img src="../<?php echo $item['image']?>" alt="gambar produk" class="detail-image"> 
                </div>
            </div>
            <div class="detail-right">
                <div class="detail-description-wrapper">
                    <h1><?php echo $item['name'] ?></h1>
                    <div class="detail-description-content">
                        <p><?php echo $item['description'] ?></p>
                    </div>
                    <hr>
                    <div class="detail-price">
                        <p><?php echo 'Rp'.$item['price'] ?></p>
                    </div>
                    <div class="detail-action">
                        <?php
                            $changeButton = "<a href='ChangeStock.php?id=".$id."'>";
                            if ($role=='admin') {
                                $changeButton=$changeButton."Ubah Stok</a>";
                            }
                            else {
                                $changeButton=$changeButton."Beli</a>";
                            }
                            echo $changeButton
                        ?>
                    </div>
                    <?php
                            if ($role=='admin') {
                    ?>
                    <div class="detail-action">
                        <a href="EditStock.php?id".<?php echo $id ?>>Edit</a>
                        <a href="">Delete</a>
                        <!-- <button onclick="document.getElementById('modal').style.display='block'" class="w3-button w3-black">Open Modal</button> -->
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- <div id="modal" class="detail-modal">
                <div class="detail-modal-content">
                    <div class="detail-modal-container">
                        <span onclick="document.getElementById('modal').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                        
                    </div>
                </div>
            </div> -->
        </div>
    </div>
    <!-- end content -->


    <!-- Footer -->
    <?php include '../partials/footer.php'; ?>
    <!-- End Footer -->
</body>

</html>