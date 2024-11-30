<?php
namespace App\Controllers;

use App\Models\User;

class AuthController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Получение данных из формы
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            // Валидация данных
            $errors = [];

            if (empty($username) || empty($email) || empty($password)) {
                $errors[] = 'Все поля обязательны для заполнения.';
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Некорректный email адрес.';
            }

            if ($password !== $confirmPassword) {
                $errors[] = 'Пароли не совпадают.';
            }

            // Проверка существования пользователя
            $userModel = new User();
            if ($userModel->userExists($username, $email)) {
                $errors[] = 'Пользователь с таким именем или email уже существует.';
            }

            if (empty($errors)) {
                if ($userModel->register($username, $email, $password)) {
                    // Регистрация успешна
                    header('Location: login.php');
                    exit();
                } else {
                    $errors[] = 'Ошибка при регистрации. Попробуйте снова.';
                }
            }

            // Отображение формы с ошибками
            include __DIR__ . '/../../views/register.php';
        } else {
            // Отображение формы регистрации
            include __DIR__ . '/../../views/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Получение данных из формы
            $username = trim($_POST['username']);
            $password = $_POST['password'];

            // Валидация данных
            $errors = [];

            if (empty($username) || empty($password)) {
                $errors[] = 'Все поля обязательны для заполнения.';
            }

            if (empty($errors)) {
                $userModel = new User();
                $user = $userModel->login($username, $password);
                if ($user) {
                    // Вход успешен
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['is_admin'] = $user['is_admin'];
                    header('Location: index.php');
                    exit();
                } else {
                    $errors[] = 'Неправильное имя пользователя или пароль.';
                }
            }

            // Отображение формы с ошибками
            include __DIR__ . '/../../views/login.php';
        } else {
            // Отображение формы входа
            include __DIR__ . '/../../views/login.php';
        }
    }
    // Другие методы будут добавлены позже
}