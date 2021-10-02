<?php
include_once('config.php');
include_once('Database/SQLiteConnection.php');
include_once('Model/User.php');
include_once('Model/Product.php');
include_once('Model/History.php');


$pdo = (new SQLiteConnection())->connect();

if ($pdo != null) {
    $User = new User($pdo);
    // $newUser = [
    //     'email' => 'example@example.co.id',
    //     'username' => 'asedese',
    //     'password' => 'admin123',
    //     'role' => 'user'
    // ];

    $userData = $User->get();
    $userData = $User->whereId(1);

    // if (password_verify('admin123', $userData[0]['password'])){
    //     echo 'equal';
    // }

    $Product = new Product($pdo);
    // $newProduct = [
    //     'name' => 'dorayaki coklat',
    //     'description' => 'dorayaki kesukaan doraemon',
    //     'price' => 35000,
    //     'stock' => 100,
    //     'image' => 'Uploads/dorayaki.jpg'
    // ];
    // $Product->insert($newProduct);
    // $Product->deleteById(4);
    $productData = $Product->get();

    $history = new History($pdo);

    // $history->insert([
    //     'user_id' => 1,
    //     'product_id' => 1,
    //     'quantity' => 3,
    //     'total_price' => 30000
    // ]);
    $historyData = $history->whereProductId(1);
} else
    echo 'Whoops, could not connect to the SQLite database!';
?>

<body>
    <?php if (sizeof($userData) > 0) { ?>
        <?php foreach ($userData as $val) { ?>
            <?php foreach ($val as $key => $value) { ?>
                <p><?= $key . '=>' . $value ?></p>
    <?php }
        }
    } ?>


    <?php if (sizeof($historyData) > 0) { ?>
        <?php foreach ($historyData as $val) { ?>
            <?php foreach ($val as  $key => $value) { ?>
                <p><?= $key . '=>' . $value  ?></p>
    <?php }
        }
    } ?>

    <img src="<?php echo $productData[0]['image'] ?>" alt="">

</body>