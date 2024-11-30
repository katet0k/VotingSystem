<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Candidate;

session_start();

// Проверка авторизации и прав администратора
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: /login.php');
    exit();
}

if (!isset($_GET['id']) || !isset($_GET['election_id'])) {
    header('Location: candidates.php');
    exit();
}

$candidateId = (int)$_GET['id'];
$electionId = (int)$_GET['election_id'];
$candidateModel = new Candidate();

if ($candidateModel->deleteCandidate($candidateId)) {
    header('Location: candidates.php?election_id=' . $electionId);
    exit();
} else {
    echo "Ошибка при удалении кандидата.";
}