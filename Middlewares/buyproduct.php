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
    sessmasihion_unset();
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

    $reducedAmount = $_POST['stock'];
    $newStock = $currentProduct['stock'] - $reducedAmount;

    if ($pdo != null) {
        $bool = $Product->buyProduct($newStock, $currentProduct['id'], $reducedAmount);

        if ($bool) {
            $users = User->whereUsername($_SESSION['username']);
            $totalPrice = $currentProduct['price'] * $reducedAmount;
            $history = [
                'user_id' => $users['id'],
                'username' => $users['username'],
                'product_id' => $currentProduct['id'],
                'product_name' => $currentProduct['name'],
                'quantity'  => $reducedAmount,
                'total_price' => $totalPrice
            ];
            $History->insert($history);
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
