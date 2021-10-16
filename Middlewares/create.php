<?php
include_once('../database/SQLiteConnection.php');
include_once('../Model/Product.php');
include_once('../config.php');


// Validate logged in
if (isset($_COOKIE['username']) && $_COOKIE['role'] === 'admin') {
    if (isset($_COOKIE['message'])) {
        alert($_COOKIE['message']);
    }
} else {
    setcookie('message', 'Login to view Doraemon Ecommerce', time() + 3600 * 24, '/');
    header("location: /Views/Login.php");
}

if (isset($_POST['create'])){
    $newProduct = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'stock' => $_POST['stock'],
    ];


    // Uploaded file
    $filename =  uniqid() . '_' . $_FILES['file']['name'];
    //the directory to upload to
    $targetDir = "../Storage/uploads/";
    $targetDirIndex = "Storage/uploads/";
    //the file being upload
    $targetFile = $targetDir.basename($_FILES['file']['name']);
    //select the file type - file extension
    $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

    // Add to array product
    $newProduct['image'] = $targetDirIndex.$filename;
    // Move file
    move_uploaded_file($_FILES['file']['tmp_name'],$targetDir.$filename);

    $databasePath = '../database/' . DATABASE_NAME . '.sqlite';
    $pdo = (new SQLiteConnection())->connect($databasePath);
    if($pdo != null) {
        $Product = new Product($pdo);
        $bool = $Product->insert($newProduct);
        if ($bool){
            setcookie('message', 'New Variant ' . $newProduct['name'] . ' created successfully', time() + 3600 * 24, '/');
            header("location: /index.php");
        } else {
            setcookie('message', 'New Variant ' . $newProduct['name'] . ' fail to create', time() + 3600 * 24, '/');
            header("location: /index.php");
        }
    } else {
        // Fail to connect
        header("location: /Views/CreateProduct.php");
    }

}