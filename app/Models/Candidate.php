<?php
namespace App\Models;

use App\Database;
use PDO;

class Candidate {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getCandidatesByElectionId($electionId) {
        $stmt = $this->db->prepare("SELECT * FROM candidates WHERE election_id = :election_id");
        $stmt->execute([':election_id' => $electionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function candidateExists($candidateId, $electionId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM candidates WHERE id = :id AND election_id = :election_id");
        $stmt->execute([
            ':id' => $candidateId,
            ':election_id' => $electionId
        ]);
        return $stmt->fetchColumn() > 0;
    }

    public function createCandidate($electionId, $name, $description) {
        $stmt = $this->db->prepare("INSERT INTO candidates (election_id, name, description) VALUES (:election_id, :name, :description)");
        return $stmt->execute([
            ':election_id' => $electionId,
            ':name' => $name,
            ':description' => $description
        ]);
    }

    public function getCandidateById($id) {
        $stmt = $this->db->prepare("SELECT * FROM candidates WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCandidate($id, $name, $description) {
        $stmt = $this->db->prepare("UPDATE candidates SET name = :name, description = :description WHERE id = :id");
        return $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':id' => $id
        ]);
    }

    public function deleteCandidate($id) {
        $stmt = $this->db->prepare("DELETE FROM candidates WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Другие методы будут добавлены позже
}