<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Database;

try {
    $db = Database::getInstance()->getConnection();
    echo "Подключение к базе данных успешно установлено!";
} catch (Exception $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}