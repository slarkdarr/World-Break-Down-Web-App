<?php
include_once('config.php');
include_once('database/SQLiteConnection.php');
include_once('Queries/Users.php');


$pdo = (new SQLiteConnection())->connect();

if ($pdo != null) {
    echo 'Connected to the SQLite database successfully!';
    $User = new Users($pdo);
    // $newUser = [
    //     'email' => 'example@example.com',
    //     'username' => 'example',
    //     'password' => 'admin123',
    //     'role' => 'admin'
    // ];
    // $User->insertUser($newUser);
    $userData = $User->getAllUsers();
} else
    echo 'Whoops, could not connect to the SQLite database!';
?>

<body>
    <?php foreach ($userData as $item) {
        foreach ($item as $val ) { ?>
            <p><?= $val ?></p>
    <?php } 
    } ?>
</body>