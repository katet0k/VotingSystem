<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Candidate;

session_start();

// Проверка авторизации и прав администратора
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: /login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: candidates.php');
    exit();
}

$candidateId = (int)$_GET['id'];
$candidateModel = new Candidate();
$candidate = $candidateModel->getCandidateById($candidateId);

if (!$candidate) {
    header('Location: candidates.php');
    exit();
}

$electionId = $candidate['election_id'];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if (empty($name)) {
        $errors[] = 'Пожалуйста, введите имя кандидата.';
    }

    if (empty($errors)) {
        if ($candidateModel->updateCandidate($candidateId, $name, $description)) {
            header('Location: candidates.php?election_id=' . $electionId);
            exit();
        } else {
            $errors[] = 'Ошибка при обновлении кандидата.';
        }
    }
} else {
    $name = $candidate['name'];
    $description = $candidate['description'];
}

include __DIR__ . '/../../views/admin/edit_candidate.php';