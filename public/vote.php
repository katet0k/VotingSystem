<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Election;
use App\Models\Candidate;
use App\Models\Vote;

session_start();

// Проверка авторизации пользователя
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Получение ID голосования из параметров URL
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}

$electionId = (int)$_GET['id'];

$electionModel = new Election();
$election = $electionModel->getElectionById($electionId);

if (!$election) {
    header('Location: index.php');
    exit();
}

// Проверка, что голосование активно
$currentTime = new DateTime();
$startTime = new DateTime($election['start_time']);
$endTime = new DateTime($election['end_time']);

if ($currentTime < $startTime || $currentTime > $endTime) {
    $error = 'Это голосование не активно.';
    include __DIR__ . '/../views/vote.php';
    exit();
}

// Проверка, голосовал ли пользователь
$voteModel = new Vote();
if ($voteModel->hasVoted($_SESSION['user_id'], $electionId)) {
    $error = 'Вы уже проголосовали в этом голосовании.';
    include __DIR__ . '/../views/vote.php';
    exit();
}

$candidateModel = new Candidate();
$candidates = $candidateModel->getCandidatesByElectionId($electionId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $candidateId = (int)$_POST['candidate_id'];

    // Проверка, что кандидат существует
    if (!$candidateModel->candidateExists($candidateId, $electionId)) {
        $error = 'Выбранный кандидат не существует.';
        include __DIR__ . '/../views/vote.php';
        exit();
    }

    // Сохранение голоса
    if ($voteModel->castVote($_SESSION['user_id'], $electionId, $candidateId)) {
        $success = 'Ваш голос успешно принят!';
    } else {
        $error = 'Произошла ошибка при сохранении вашего голоса.';
    }
}

include __DIR__ . '/../views/vote.php';