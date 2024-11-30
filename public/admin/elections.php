<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Models\Election;

session_start();

// Проверка авторизации и прав администратора
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: /login.php');
    exit();
}

$electionModel = new Election();
$elections = $electionModel->getAllElections();

include __DIR__ . '/../../views/admin/elections.php';