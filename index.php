<?php
include_once('config.php');
include_once('Database/SQLiteConnection.php');
include_once('Model/Product.php');

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

// Check page for pagination ?page=
if (!isset ($_GET['page']) ) {  
    $page = 1;  
} else {  
    $page = $_GET['page'];  
} 

$resultsPerPage = 10;  
$pageFirstResult = ($page-1) * $resultsPerPage;  

// Sqlite conn
$databasePath = 'database/doraemon.sqlite';
$pdo = (new SQLiteConnection())->connect($databasePath);
$product = new Product($pdo);
// Get number of pages from database
$countData = $product->count();
$numberOfPage = ceil ($countData / $resultsPerPage);  
$products = $product->getPaginated($pageFirstResult, $resultsPerPage);
?>

<body>
    <!-- Navbar -->

    <!-- Content -->
    <div>
        <?php foreach ($products as $product) { ?>
            <div class="product">
                <p><?= $product['name'] ?></p>
                <p><?= $product['description'] ?></p>
                <p><?= $product['price'] ?></p>
                <p><?= $product['stock'] ?></p>
                <img src="<?php echo $product['image'] ?>" alt="Dorayaki image">
            </div>
        <?php } ?>
    </div>
    <!-- Footer -->

</body>

</html>