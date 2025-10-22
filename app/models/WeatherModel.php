<?php
// app/models/WeatherModel.php

require_once __DIR__ . '/../../config/config.php';

class WeatherModel {
    public static function getWeatherData($city) {
        global $API_KEY, $BASE_URL;

        $url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$API_KEY}&units=metric";

        // Try with User-Agent header
        $context = stream_context_create([
            "http" => [
                "method" => "GET",
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36"
            ]
        ]);

        $response = @file_get_contents($url, false, $context);

        // If that fails, try without headers
        if ($response === false) {
            $response = @file_get_contents($url);
        }

        if ($response === false) {
            return null;
        }

        $data = json_decode($response, true);

        // Check if API returned an error
        if (isset($data['cod']) && $data['cod'] != 200) {
            return null;
        }

        return $data;
    }

    public static function getAirQuality($lat, $lon) {
        global $API_KEY;

        $url = "http://api.openweathermap.org/data/2.5/air_pollution?lat={$lat}&lon={$lon}&appid={$API_KEY}";

        $context = stream_context_create([
            "http" => [
                "method" => "GET",
                "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36"
            ]
        ]);

        $response = @file_get_contents($url, false, $context);

        if ($response === false) {
            return null;
        }

        return json_decode($response, true);
    }
}
