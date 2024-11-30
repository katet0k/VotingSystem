<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Election;

session_start();

// Проверка авторизации и прав администратора
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: /login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: elections.php');
    exit();
}

$electionId = (int)$_GET['id'];
$electionModel = new Election();

if ($electionModel->deleteElection($electionId)) {
    header('Location: elections.php');
    exit();
} else {
    echo "Ошибка при удалении голосования.";
}