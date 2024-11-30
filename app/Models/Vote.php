<?php
namespace App\Models;

use App\Database;
use PDO;

class Vote {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function hasVoted($userId, $electionId) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM votes WHERE user_id = :user_id AND election_id = :election_id");
        $stmt->execute([
            ':user_id' => $userId,
            ':election_id' => $electionId
        ]);
        return $stmt->fetchColumn() > 0;
    }

    public function castVote($userId, $electionId, $candidateId) {
        $stmt = $this->db->prepare("INSERT INTO votes (user_id, election_id, candidate_id) VALUES (:user_id, :election_id, :candidate_id)");
        return $stmt->execute([
            ':user_id' => $userId,
            ':election_id' => $electionId,
            ':candidate_id' => $candidateId
        ]);
    }

    // Другие методы будут добавлены позже
}