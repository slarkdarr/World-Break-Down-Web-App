<?php
include_once("../config.php");

$tables = [
    'users' => 'DROP TABLE IF EXISTS users; CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY NOT NULL,
        email TEXT NOT NULL,
        username TEXT UNIQUE NOT NULL,
        password TEXT NOT NULL,
        role TEXT NOT NULL
    );',
    'products' => 'DROP TABLE IF EXISTS products; CREATE TABLE IF NOT EXISTS products (
        id INTEGER PRIMARY KEY NOT NULL,
        name TEXT NOT NULL,
        description TEXT,
        price INTEGER NOT NULL,
        stock INTEGER NOT NULL,
        image TEXT
    );',
    'histories' => 'DROP TABLE IF EXISTS histories; CREATE TABLE IF NOT EXISTS histories (
        id INTEGER PRIMARY KEY NOT NULL,
        user_id INTEGER,
        product_id INTEGER,
        quantity INTEGER,
        total_price INTEGER,
        date TEXT,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    );',
];

function initDatabase (PDO $pdo, array $tables){
    foreach ($tables as $tablesName => $query){
        $pdo->exec($query);
    }
}

try {
    $db = new PDO('sqlite:' . DATABASE_NAME.  '.sqlite');
    initDatabase($db, $tables);
    echo 'database initialized';

    $query = 'INSERT INTO users (email, username, password, role) VALUES (:email, :username, :password, :role);';
    $stmt = $db->prepare($query);
    $stmt->execute([
        ':email' => 'admin@admin.com',
        ':username' => 'admin',
        ':password' => password_hash('admin123', PASSWORD_DEFAULT),
        'role'  => 'admin'
    ]);
    // $db->exec('INSERT INTO users (email, username, password, role) VALUES ("jafar@jafar.com", "halogais", "123456", "admin");');
    // $db->exec('INSERT INTO products (name, description, price, stock, image)  VALUES ("dorayaki", "dorayaki sedap", 30000, 100, "image");');
    // $datetime = $timestamp = date('Y-m-d H:i:s');
    // echo $datetime;
    // $hist = $db->prepare('INSERT INTO histories (user_id, product_id, quantity, total_price, date) VALUES (1,1,10, 300000, :datetime);');
    // $hist->bindValue(':datetime', $datetime);
    // $hist->execute();
} catch (PDOException $e) {
    echo $e->getMessage();
}



?>