<?php
include_once('../database/SQLiteConnection.php');
include_once('../Model/User.php');
include_once('../config.php');


if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $databasePath = '../database/' . DATABASE_NAME . '.sqlite';
    $pdo = (new SQLiteConnection())->connect($databasePath);

    if ($pdo != null) {
        $User = new User($pdo);
        $userData = $User->whereUsername($username);

        if (!count($userData)) {
            echo 'true';
        } else {
            echo 'false';
        }
    } else {
        echo 'false';
    }
}
