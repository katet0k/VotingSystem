<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Candidate;

session_start();

// Проверка авторизации и прав администратора
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: /login.php');
    exit();
}

if (!isset($_GET['election_id'])) {
    header('Location: candidates.php');
    exit();
}

$electionId = (int)$_GET['election_id'];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if (empty($name)) {
        $errors[] = 'Пожалуйста, введите имя кандидата.';
    }

    if (empty($errors)) {
        $candidateModel = new Candidate();
        if ($candidateModel->createCandidate($electionId, $name, $description)) {
            header('Location: candidates.php?election_id=' . $electionId);
            exit();
        } else {
            $errors[] = 'Ошибка при добавлении кандидата.';
        }
    }
}

include __DIR__ . '/../../views/admin/create_candidate.php';