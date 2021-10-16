<?php
include_once('../database/SQLiteConnection.php');
include_once('../Model/Product.php');
include_once('../config.php');

// Validate logged in
if (!isset($_COOKIE['username']) || !isset($_COOKIE['role']) || $_COOKIE['role'] !== 'admin') {
    setcookie('message', 'Login to view Doraemon Ecommerce', time() + 3600 * 24, '/');
    header("location: /Views/Login.php");
}

if (isset($_POST['edit'])) {

    $databasePath = '../database/' . DATABASE_NAME . '.sqlite';
    $pdo = (new SQLiteConnection())->connect($databasePath);
    $Product = new Product($pdo);
    $oldProduct = $Product->whereId($_POST['id']);

    $newProduct = [
        'id'    => $_POST['id'],
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'stock' => $_POST['stock'],
        'image' => $oldProduct[0]['image']
    ];

    if ($_FILES['file']) {
        // Uploaded file
        $filename =  uniqid() . '_' . $_FILES['file']['name'];
        //the directory to upload to
        $targetDir = "../Storage/uploads/";
        $targetDirIndex = "Storage/uploads/";
        //the file being upload
        $targetFile = $targetDir . basename($_FILES['file']['name']);
        //select the file type - file extension
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        //valid file extensions we will allow
        $extensions_arr = array("jpg", "jpeg", "png");
        //checking the extension of our uploaded file

        if (in_array($fileType, $extensions_arr)) {
            // Add to array product
            $newProduct['image'] = $targetDirIndex . $filename;
            // Move file
            move_uploaded_file($_FILES['file']['tmp_name'], $targetDir . $filename);
        } else {
            // Fail extension type not found
            header("location: /index.php");
        }
    }
    if ($pdo != null) {
        $bool = $Product->update($newProduct);
        if ($bool) {
            setcookie('message', 'Variant ' . $newProduct['name'] . ' updated successfully', time() + 3600 * 24, '/');
            header("location: /index.php");
        } else {
            setcookie('message', 'Variant ' . $newProduct['name'] . ' fail to create', time() + 3600 * 24, '/');
            header("location: /index.php");
        }
    } else {
        // Fail to connect
        header("location: /index.php");
    }
} else {
    header("location: /index.php");
}
