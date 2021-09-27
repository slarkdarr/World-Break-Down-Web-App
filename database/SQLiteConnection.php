<?php
include_once('config.php');

/**
 * SQLite connnection
 */
class SQLiteConnection
{
    /**
     * PDO instance
     * @var type 
     */
    private $pdo;

    /**
     * return in instance of the PDO object that connects to the SQLite database
     * @return \PDO
     */
    public function connect()
    {
        if ($this->pdo == null) {
            try {
                $this->pdo = new \PDO("sqlite:" . DATABASE_PATH);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }
        return $this->pdo;
    }
}
