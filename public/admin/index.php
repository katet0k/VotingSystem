<?php
require_once __DIR__ . '/../../vendor/autoload.php';

session_start();

// Проверка авторизации и прав администратора
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: /login.php');
    exit();
}

include __DIR__ . '/../../views/admin/index.php';