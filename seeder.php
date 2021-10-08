<?php
include_once('config.php');
include_once('Database/SQLiteConnection.php');
include_once('Model/User.php');
include_once('Model/Product.php');
include_once('Model/History.php');

$databasePath = 'database/' . DATABASE_NAME . '.sqlite';
$pdo = (new SQLiteConnection())->connect($databasePath);

if ($pdo != null) {
    $User = new User($pdo);
    // $newUser = [
    //     'email' => 'user@user.co.id',
    //     'username' => 'user',
    //     'password' => 'user123',
    //     'role' => 'user'
    // ];
    // $User->insert($newUser);

    $userData = $User->get();
    $userData = $User->whereId(1);

    // Product seeder
    $Product = new Product($pdo);
    for ($i = 0; $i < 25; $i++){
        $newProduct = [
            'name' => 'dorayaki ' . $i,
            'description' => 'dorayaki kesukaan doraemon',
            'price' => 35000,
            'stock' => 100,
            'image' => 'Assets/uploads/dorayaki.jpg'
        ];
        $Product->insert($newProduct);
    }



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