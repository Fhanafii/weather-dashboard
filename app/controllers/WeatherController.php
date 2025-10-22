<?php
// app/controllers/WeatherController.php

require_once __DIR__ . '/../models/WeatherModel.php';

class WeatherController {
    public static function showDashboard($city) {
        $weather = WeatherModel::getWeatherData($city);
        $air = null;

        if ($weather && isset($weather['coord'])) {
            $lat = $weather['coord']['lat'];
            $lon = $weather['coord']['lon'];
            $air = WeatherModel::getAirQuality($lat, $lon);
        }

        // Debug: Print weather data
        // echo "<pre>Weather Data: ";
        // print_r($weather);
        // echo "</pre>";

        // Send data to the view
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/dashboard.php';
        include __DIR__ . '/../views/footer.php';
    }
}
