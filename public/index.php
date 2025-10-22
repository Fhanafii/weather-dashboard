<?php
// public/index.php

require_once __DIR__ . '/../app/controllers/WeatherController.php';

// Default city if user doesn’t search yet
$city = $_GET['city'] ?? 'Jakarta';

// Call controller to handle the request
WeatherController::showDashboard($city);
?>