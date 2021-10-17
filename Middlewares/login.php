<?php
include_once('../database/SQLiteConnection.php');
include_once('../Model/User.php');
include_once('../config.php');

if (isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $databasePath = '../database/' . DATABASE_NAME . '.sqlite';
    $pdo = (new SQLiteConnection())->connect($databasePath);

    if ($pdo != null) {
        $User = new User($pdo);
        $userData = $User->whereUsername($username);


        if (!count($userData)) {
            setcookie('message', 'username invalid', time() + 3600 * 24, '/');
            echo $_COOKIE['message'];
            header("location: /Views/Login.php");
        } else {
            if (password_verify($password, $userData[0]['password'])) {
                setcookie('message', "login success, welcome $username", time() + 3600 * 24, '/');
                // GENERATE TOKEN
                setcookie('userLoggedIn', $username, time() + 3600 * 24, '/');
                setcookie('token', md5($username . SECRET_WORD) , time() + 3600 * 24, '/');
                // Save username and role to session
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $userData[0]['role'];
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