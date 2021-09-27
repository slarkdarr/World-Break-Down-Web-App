<?php

/**
 * Users query class
 */

class Users
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
     * Insert a new user into the users table
     * @param array $user consist of (email, username, password, role)
     * @return the id of the new user
     */
    public function insertUser($user)
    {
        $query = 'INSERT INTO users (email, username, password, role) VALUES (:email, :username, :password, :role);';
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':email' => $user['email'],
            ':username' => $user['username'],
            ':password' => password_hash($user['password'], PASSWORD_DEFAULT),
            'role'  => $user['role']
        ]);

        return $this->pdo->lastInsertId();
    }

    /**
     * @return all user in users table
     */
    public function getAllUsers()
    {
        $stmt = $this->pdo->query('SELECT * FROM users');
        $users = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $users[] = [
                'id' => $row['id'],
                'email' => $row['email'],
                'username' => $row['username'],
                'password' => $row['password'],
                'role' => $row['role']
            ];
        }
        return $users;
    }
}
