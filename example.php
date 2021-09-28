<?php
include_once('config.php');
include_once('database/SQLiteConnection.php');
include_once('Queries/Users.php');
include_once('Queries/Products.php');


$pdo = (new SQLiteConnection())->connect();

if ($pdo != null) {
    $User = new Users($pdo);
    // $newUser = [
    //     'email' => 'example@example.co.id',
    //     'username' => 'asedese',
    //     'password' => 'admin123',
    //     'role' => 'user'
    // ];

    $userData = $User->get();
    $userData = $User->whereId(2);

    $Product = new Products($pdo);
    $newProduct = [
        'name' => 'dorayaki coklat',
        'description' => 'dorayaki kesukaan doraemon',
        'price' => 35000,
        'stock' => 100,
        'image' => 'Uploads/dorayaki.jpg'
    ];
    $Product->insert($newProduct);
    // $Product->deleteById(10);
    $productData = $Product->get();
    var_dump($productData[0]); 


    // if (password_verify('admin123', $userData[0]['password'])){
    //     echo 'equal';
    // }
} else
    echo 'Whoops, could not connect to the SQLite database!';
?>

<body>
    <?php foreach ($userData as $item) {
        foreach ($item as $val) { ?>
            <p><?= $val ?></p>
    <?php }
    } ?>

    <img src="<?php echo $productData[0]['image']?>" alt="">

</body>