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

// Validate logged in
include_once('../config.php');

if (isset($_COOKIE['token']) && isset($_COOKIE['userLoggedIn'])) {
    session_start();
    if ((md5($_COOKIE['userLoggedIn'] . SECRET_WORD)) !== $_COOKIE['token'] || $_SESSION['role'] !== 'admin') {
        setcookie('message', 'Prohibited', time() + 3600 * 24, '/');
        header("location: /Views/Login.php");
    }
} else {
    setcookie('message', 'Prohibited', time() + 3600 * 24, '/');
    header("location: /Views/Login.php");
}
?>

<body>
    <!-- Navbar -->

    <!-- End Navbar -->

    <!-- Content -->
    <div class="content">
        <div class="wrapper">
            <h3 class="title">Create DORAYAKI</h3>
            <form class="form" action="../Middlewares/create.php" method="POST" enctype="multipart/form-data">

                <div class="input-field">
                    <label for="name">DORAYAKI Variant</label>
                    <input type="text" id="name" name="name" placeholder="Variant of product here .." required>
                </div>

                <div class="input-field">
                    <label for="description">Description</label>
                    <textarea class="textarea" name="description" id="description" cols="30" rows="5" placeholder="Description goes here ..." required></textarea>
                </div>

                <div class="input-field">
                    <label for="price">Price (Rupiah) </label>
                    <input type="number" min='0' step="100" id="price" name="price" required>
                </div>

                <div class="input-field">
                    <label for="price">Stock</label>
                    <input type="number" min='0' id="stock" name="stock" required>
                </div>

                <div class="input-field">
                    <label for="file">Image</label>
                    <input class="upload" type="file" id="file" name="file" accept=".png,.jpg,.jpeg" required>
                </div>

                <div class="input-field">
                    <input class="button" type="submit" id="submit" name="create" value="Create">
                </div>

            </form>
        </div>
    </div>
    <!-- end content -->


    <!-- Footer -->

    <!-- End  Footer -->


</body>

</html>