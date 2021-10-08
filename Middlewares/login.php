<?php
include_once('../database/SQLiteConnection.php');
include_once('../Model/User.php');
include_once('../config.php');

function validateUser($username, $data)
{
    foreach ($data as $key => $val) {
        if ($val['username'] === $username || $val['email'] === $username) return $key;
    }
    return -1;
}

if (isset($_POST['login'])) {
    $username = $_POST["username"]; // can be email too
    $password = $_POST["password"];
    $databasePath = '../database/' . DATABASE_NAME . '.sqlite';
    $pdo = (new SQLiteConnection())->connect($databasePath);

    if ($pdo != null) {
        $User = new User($pdo);
        $userData = $User->get();
        $index = validateUser($username, $userData);

        if ($index == -1) {
            setcookie('message', 'username invalid', time() + 3600 * 24, '/');
            echo $_COOKIE['message'];
            header("location: /Views/Login.php");
        } else {
            if (password_verify($password, $userData[$index]['password'])) {
                setcookie('message', "login success, welcome $username", time() + 3600 * 24, '/');
                setcookie('username', $username, time() + 3600 * 24, '/');
                header("location: /index.php");
            } else {
                setcookie('message',  "password invalid", time() + 3600 * 24, '/');
                header("location: /Views/login.php");
            }
        }
    } else {
        echo 'Whoops, could not connect to the SQLite database!';
    }
}
