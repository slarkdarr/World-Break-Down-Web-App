<?php
include_once('config.php');
include_once('database/SQLiteConnection.php');
include_once('Queries/Users.php');


$pdo = (new SQLiteConnection())->connect();

if ($pdo != null) {
    echo 'Connected to the SQLite database successfully!';
    $User = new Users($pdo);
    $newUser = [
        'email' => 'example@example.com',
        'username' => 'admin',
        'password' => 'admin123',
        'role' => 'admin'
    ];
    $User->insertUser($newUser);
    var_dump($User->getAllUsers());
} else
    echo 'Whoops, could not connect to the SQLite database!';
