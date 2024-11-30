<?php
namespace App\Models;

use App\Database;
use PDO;

class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function userExists($username, $email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
        $stmt->execute([
            ':username' => $username,
            ':email' => $email
        ]);
        return $stmt->fetchColumn() > 0;
    }

    public function register($username, $email, $password) {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hash
        ]);
    }

    public function login($usernameOrEmail, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :identifier OR email = :identifier");
        $stmt->execute([':identifier' => $usernameOrEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }
    // Другие методы будут добавлены позже
}