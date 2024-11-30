<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Election;

session_start();

// Проверка авторизации и прав администратора
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: /login.php');
    exit();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    if (empty($title) || empty($start_time) || empty($end_time)) {
        $errors[] = 'Пожалуйста, заполните все обязательные поля.';
    }

    if (strtotime($start_time) >= strtotime($end_time)) {
        $errors[] = 'Дата начала должна быть раньше даты окончания.';
    }

    if (empty($errors)) {
        $electionModel = new Election();
        if ($electionModel->createElection($title, $description, $start_time, $end_time)) {
            header('Location: elections.php');
            exit();
        } else {
            $errors[] = 'Ошибка при создании голосования.';
        }
    }
}

include __DIR__ . '/../../views/admin/create_election.php';