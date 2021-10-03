<?php
include_once('../database/SQLiteConnection.php');
include_once('../Model/User.php');

function validateUser($username, $data)
{
    foreach ($data as $key => $val) {
        if (array_key_exists($username, $val)) {
            return $key;
        }
    }
    return -1;
}

session_start();
if (isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $databasePath = '../database/doraemon.sqlite';
    $pdo = (new SQLiteConnection())->connect($databasePath);

    if ($pdo != null) {
        $User = new User($pdo);
        $userData = $User->get();
        var_dump($userData);
        // $index = validateUser($username, $userData);
    } else{
        echo 'Whoops, could not connect to the SQLite database!';
    }


    // if ($index == -1) {
    //     $_SESSION['message'] = "username invalid";
    //     header("location:" . URL . "Views/login.php");
    // } else {
    //     $pw = $userData[$index][$username];
    //     if ($pw == $password) {
    //         $_SESSION['message'] = "login success, welcome $username";
    //         $_SESSION['username'] = $username;
    //         header("location:" . URL . "index.php");
    //     } else {
    //         $_SESSION['message'] = "password invalid";
    //         header("location:" . URL . "Views/login.php");
    //     }
    // }
}
