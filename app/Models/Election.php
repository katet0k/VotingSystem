<?php
namespace App\Models;

use App\Database;
use PDO;

class Election {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getActiveElections() {
        $stmt = $this->db->prepare("SELECT * FROM elections WHERE start_time <= NOW() AND end_time >= NOW()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getElectionById($id) {
        $stmt = $this->db->prepare("SELECT * FROM elections WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllElections() {
        $stmt = $this->db->prepare("SELECT * FROM elections ORDER BY start_time DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createElection($title, $description, $start_time, $end_time) {
        $stmt = $this->db->prepare("INSERT INTO elections (title, description, start_time, end_time) VALUES (:title, :description, :start_time, :end_time)");
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':start_time' => $start_time,
            ':end_time' => $end_time
        ]);
    }

    public function updateElection($id, $title, $description, $start_time, $end_time) {
        $stmt = $this->db->prepare("UPDATE elections SET title = :title, description = :description, start_time = :start_time, end_time = :end_time WHERE id = :id");
        return $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':start_time' => $start_time,
            ':end_time' => $end_time,
            ':id' => $id
        ]);
    }

    public function deleteElection($id) {
        $stmt = $this->db->prepare("DELETE FROM elections WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Другие методы будут добавлены позже
}