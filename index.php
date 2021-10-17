<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Assets/css/index.css" />
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/55c10e2ab9.js" crossorigin="anonymous"></script>

    <title>Jajan.id</title>
</head>

<?php
include_once('config.php');
include_once('database/SQLiteConnection.php');
include_once('Model/Product.php');

function alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
    setcookie('message', '', time() - 3600, '/');
}
// Validate logged in
if (isset($_COOKIE['token']) && isset($_COOKIE['userLoggedIn'])) {
    if ((md5($_COOKIE['userLoggedIn'] . SECRET_WORD)) === $_COOKIE['token']) {
        if (isset($_COOKIE['message'])) {
            alert($_COOKIE['message']);
        }
        session_start();
        $role = $_SESSION['role'];
    }
} else {
    setcookie('message', 'Login to view Doraemon Ecommerce', time() + 3600, '/');
    header("location: /Views/Login.php");
}

// Check page for pagination ?page=
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}

$resultsPerPage = 10;
$pageResult = ($page - 1) * $resultsPerPage;

// Sqlite conn
$databasePath = 'database/doraemon.sqlite';
$pdo = (new SQLiteConnection())->connect($databasePath);
$product = new Product($pdo);
// Get number of pages from database
$countData = $product->count();
$numberOfPage = ceil($countData / $resultsPerPage);
$products = $product->getPaginated($pageResult, $resultsPerPage);


?>

<body>
    <!-- Navbar -->
    <?php include 'partials/navbar.php'; ?>
    <!-- End navbar -->

    <!-- Content -->
    <div class="content">
        <?php if ($role === 'admin') { ?>
            <div class="add-product">
                <a href="Views/CreateProduct.php" class="button"><i class="fas fa-plus"></i>Variant</a>
            </div>
        <?php } ?>
        <section class="product-section">
            <div class="products" id="products">
                <?php foreach ($products as $product) { ?>
                    <a href='product.php?id=<?php echo $product['id']; ?>' id='<?= $product['id'] ?>'>
                        <div class='product-card' id='<?= $product['id'] ?>'>
                            <div class='product-image'>
                                <img src='<?= $product['image'] ?>' alt='<?= $product['name'] ?>' />
                            </div>
                            <div class='product-info'>
                                <div class='title text' id='title-item'><?= $product['name'] ?></div>
                                <div class='sub-info'>
                                    <div class='price'>Rp<?= $product['price'] ?></div>
                                    <div class='rating'>
                                        Terjual <?= $product['sold'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </section>

        <?php if ($numberOfPage >= $page) { ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $numberOfPage; $i++) { ?>
                    <!-- <a href="#">&laquo;</a> -->
                    <a href="?page=<?php echo $i; ?>" class=<?php echo ($page == $i) ? 'active'  : '' ?>><?= $i ?></a>
                    <!-- <a class="active" href="#">2</a>
                <!-- <a href="#">&raquo;</a> -->
                <?php  } ?>
            </div>
        <?php  } ?>



    </div>
    <!-- end content -->


    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>
    <!-- End Footer -->

</body>

</html>