<?php
include_once('../database/SQLiteConnection.php');
include_once('../Model/Product.php');
include_once('../config.php');

// Validate logged in
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

if (isset($_POST['buy'])) {

    $databasePath = '../database/' . DATABASE_NAME . '.sqlite';
    $pdo = (new SQLiteConnection())->connect($databasePath);
    $Product = new Product($pdo);
    $currentProduct = $Product->whereId($_POST['id']);

    $newStock = 'stock' => $_POST['stock'];

    if ($pdo != null) {
        $bool = $Product->changeStock($newStock, $currentProduct['id']);
        if ($bool) {
            setcookie('message', 'Variant ' . $currentProduct['name'] . ' stock successfully changed ', time() + 3600, '/');
            header("location: /index.php");
        } else {
            setcookie('message', 'Variant ' . $currentProduct['name'] . ' stock failed to be changed ', time() + 3600, '/');
            header("location: /index.php");
        }
    } else {
        // Fail to connect
        header("location: /index.php");
    }
} else {
    header("location: /index.php");
}

>