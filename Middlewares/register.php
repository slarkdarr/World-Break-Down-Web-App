<?php
include_once('../database/SQLiteConnection.php');
include_once('../Model/User.php');
include_once('../config.php');

function countDbRows($pdo, $checkdataquery)
{
    $counting = "SELECT COUNT(*) FROM ($checkdataquery)";
    $count = $pdo->query($counting);

    return $count;
}

if (isset($_POST['register'])) {
    $databasePath = '../database/doraemon.sqlite';
    $pdo = (new SQLiteConnection())->connect($databasePath);

    if ($pdo != null) {
        $user = new User($pdo);

        if (isset($_POST['username'])) {
            $username = $_POST['username'];

            $checkdata = "SELECT username FROM users WHERE username='$username'";

            $query = $pdo->query($checkdata);

            if (countDbRows($pdo, $checkdata) > 0) {
                setcookie('message', 'Username already exists!', time() + 3600 * 24, '/');
                echo $_COOKIE['message'];
                header("location:" . URL . "Views/Register.php");
            } else {
                // $user->insert();
                setcookie('message', 'Register success! Welcome $username', time() + 3600 * 24, '/');
                echo $_COOKIE['message'];
                setcookie('username', $username, time() + 3600 * 24, '/');
                header("location:" . URL . "index.php");
            }
        }
    } else {
        echo "Couldn't connect to the SQLite Database!";
    }
}
