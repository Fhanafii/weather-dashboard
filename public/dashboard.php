<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: /public/login.php");
    exit();
}

require_once __DIR__ . '/../app/controllers/WeatherController.php';

$city = $_GET['city'] ?? 'Jakarta';

WeatherController::showDashboard($city);
?>