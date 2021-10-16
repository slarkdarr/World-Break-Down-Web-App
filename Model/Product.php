<?php

/**
 * Products query class
 */

class Product
{
    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;

    /**
     * Initialize the object with a specified PDO object
     * @param \PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Insert a new product into the products table
     * @param array $product consist of (name, description, price, stock, image)
     * @return boolean success
     */
    public function insert($product)
    {
        try {
            $query = 'INSERT INTO products (name, description, price, stock, image, sold) VALUES (:name, :description, :price, :stock, :image, 0);';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':name' => $product['name'],
                ':description' => $product['description'],
                ':price' => $product['price'],
                ':stock'  => $product['stock'],
                ':image'  => $product['image'],
            ]);
            return true;
        } catch (\PDOException $Exception) {
            return false;
        }
    }

    /**
     * @return associativeArray Products
     */
    public function get()
    {
        $stmt = $this->pdo->query('SELECT * FROM products ORDER BY sold DESC;');
        $products = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $products[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'stock'  => $row['stock'],
                'image'  => $row['image'],
                'sold'  => $row['sold'],
            ];
        }
        return $products;
    }

    /**
     * @param integer|string $pageFirstResult
     * @param integer|string $resultPerPage
     * @return associativeArray Products with paginated
     */
    public function getPaginated($pageFirstResult, $resultPerPage)
    {
        $stmt = $this->pdo->query('SELECT * FROM products ORDER BY sold DESC LIMIT ' . $pageFirstResult . ',' . $resultPerPage . ';');
        $products = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $products[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'stock'  => $row['stock'],
                'image'  => $row['image'],
                'sold'  => $row['sold'],
            ];
        }
        return $products;
    }

    /**
     * @param string|integer $id
     * @return associative array based on condition
     */
    public function whereId($id)
    {
        $query = 'SELECT * FROM products WHERE id = :id ;';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':id' => $id
        ]);

        $products = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $products[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'price' => $row['price'],
                'stock'  => $row['stock'],
                'image'  => $row['image'],
                'sold'  => $row['sold'],
            ];
        }
        return $products;
    }

    /**
     * @param string $id
     * @return integer numberofRows deleted
     */
    public function deleteById($id){
        $query = 'DELETE FROM products WHERE id = :id ;';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * @return integer $numberOfRow
     */
    public function count(){
        $stmt = $this->pdo->prepare('SELECT COUNT(*) as count FROM products');
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }
}
