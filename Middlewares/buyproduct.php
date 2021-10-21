<?php
include_once('../database/SQLiteConnection.php');
include_once('../Model/Product.php');
include_once('../Model/History.php');
include_once('../Model/User.php');
include_once('../config.php');

// Validate logged in
session_start();
if (isset($_COOKIE['token']) && isset($_COOKIE['userLoggedIn'])) {
    if ((md5($_COOKIE['userLoggedIn'] . SECRET_WORD)) !== $_COOKIE['token'] || $_SESSION['role'] !== 'user') {
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

if (isset($_POST['buy'])) {

    $databasePath = '../database/' . DATABASE_NAME . '.sqlite';
    $pdo = (new SQLiteConnection())->connect($databasePath);
    $Product = new Product($pdo);
    $History = new History($pdo);
    $User = new User($pdo);
    $currentProduct = $Product->whereId($_POST['id']);

    $newStock = $_POST['stock'];

    if ($pdo != null) {
        $bool = $Product->changeStock($newStock, $currentProduct['id']);

        if ($bool) {
            $users = User->whereUsername($_SESSION['username']);
            $total_price = $currentProduct[3]*$newStock;
            $history = [
                'user_id' => $users[0],
                'username' => $users[2],
                'product_id' => $currentProduct[0],
                'product_name' => $currentProduct[1],
                'quantity'  => $newStock,
                'total_price' => $currentProduct[0]
            ];
            $History->insert();
            // Set cookie
            setcookie('message', 'Variant ' . $currentProduct['name'] . ' successfully bought', time() + 3600, '/');
            header("location: /index.php");
        } else {
            setcookie('message', 'Variant ' . $currentProduct['name'] . ' failed to be bought', time() + 3600, '/');
            header("location: /index.php");
        }
    } else {
        // Fail to connect
        header("location: /index.php");
    }
} else {
    header("location: /index.php");
}