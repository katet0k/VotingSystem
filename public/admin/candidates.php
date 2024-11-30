<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Election;
use App\Models\Candidate;

session_start();

// Проверка авторизации и прав администратора
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: /login.php');
    exit();
}

$electionModel = new Election();
$elections = $electionModel->getAllElections();

$candidateModel = new Candidate();

$selectedElectionId = isset($_GET['election_id']) ? (int)$_GET['election_id'] : null;
$candidates = [];

if ($selectedElectionId) {
    $candidates = $candidateModel->getCandidatesByElectionId($selectedElectionId);
}

include __DIR__ . '/../../views/admin/candidates.php';