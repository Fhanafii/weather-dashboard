<?php
// app/controllers/WeatherController.php

require_once __DIR__ . '/../models/WeatherModel.php';

class WeatherController {
    private static function getCustomIcon($icon) {
        $code = substr($icon, 0, 2);
        switch($code) {
            case '01': return 'clearsky.svg';
            case '02': return 'fewclouds.svg';
            case '03':
            case '04': return 'brokenclouds.svg';
            case '09':
            case '10': return 'rain.svg';
            case '11': return 'thunderstrom.svg';
            default: return false; // Use default OpenWeatherMap icon
        }
    }

    public static function showDashboard($city) {
        $weather = WeatherModel::getWeatherData($city);
        $air = null;
        $forecast = WeatherModel::getForecastData($city);

        if ($weather && isset($weather['coord'])) {
            $lat = $weather['coord']['lat'];
            $lon = $weather['coord']['lon'];
            $air = WeatherModel::getAirQuality($lat, $lon);
        }

        // Calculate tomorrow's weather data for the view
        $tomorrow_date = date('Y-m-d', strtotime('+1 day'));
        $tomorrow_temp = '—';
        $tomorrow_desc = 'Tidak diketahui';
        $location = isset($weather['name']) ? $weather['name'] : 'Jakarta';
        $tomorrow_bg = 'assets/img/nighttheme.png'; // default
        if ($forecast && isset($forecast['list'])) {
            foreach ($forecast['list'] as $item) {
                $dt = date('Y-m-d', strtotime($item['dt_txt']));
                if ($dt === $tomorrow_date) {
                    $tomorrow_temp = round($item['main']['temp']) . '°C';
                    $tomorrow_desc = ucfirst($item['weather'][0]['description']);
                    // Check for rain
                    if (stripos($tomorrow_desc, 'rain') !== false) {
                        $tomorrow_bg = 'assets/img/raintheme.png';
                    }
                    break;
                }
            }
        }

        // Determine background based on current time
        $current_hour = date('H');
        if ($current_hour >= 6 && $current_hour <= 11) {
            $time_bg = 'assets/img/sunnytheme.png'; // morning sunny
        } elseif ($current_hour >= 12 && $current_hour <= 17) {
            $time_bg = 'assets/img/sunnytheme.png'; // afternoon sunny
        } elseif ($current_hour >= 18 && $current_hour <= 20) {
            $time_bg = 'assets/img/dusktheme.png'; // dusk
        } else {
            $time_bg = 'assets/img/nighttheme.png'; // night
        }

        // Use time-based background unless tomorrow is rain
        $final_bg = (stripos($tomorrow_desc, 'rain') !== false) ? $tomorrow_bg : $time_bg;

        // Calculate AQI status and progress for the view
        $aqi_status = 'Tidak diketahui';
        $aqi_progress = '0%';
        if ($air && isset($air['list'][0]['main']['aqi'])) {
            $aqi = $air['list'][0]['main']['aqi'];
            if ($aqi == 1) $aqi_status = 'Baik';
            elseif ($aqi == 2) $aqi_status = 'Sedang';
            elseif ($aqi == 3) $aqi_status = 'Tidak Sehat';
            elseif ($aqi == 4) $aqi_status = 'Sangat Tidak Sehat';
            elseif ($aqi == 5) $aqi_status = 'Berbahaya';
            $aqi_progress = ($aqi * 20) . '%';
        }

        // Process forecast data for today and tomorrow
        $today_forecast = [];
        $tomorrow_forecast = [];
        if ($forecast && isset($forecast['list'])) {
            $today = date('Y-m-d');
            $tomorrow = date('Y-m-d', strtotime('+1 day'));
            $today_count = 0;
            $tomorrow_count = 0;
            foreach ($forecast['list'] as $item) {
                $dt = date('Y-m-d', strtotime($item['dt_txt']));
                if ($dt === $today && $today_count < 8) {
                    $time = date('H:i', strtotime($item['dt_txt']));
                    $temp = round($item['main']['temp']);
                    $humidity = $item['main']['humidity'];
                    $windSpeed = $item['wind']['speed'];
                    $description = ucfirst($item['weather'][0]['description']);
                    $icon = $item['weather'][0]['icon'];
                    $customIcon = self::getCustomIcon($icon);
                    $iconSrc = $customIcon ? "assets/icons/{$customIcon}" : "https://openweathermap.org/img/wn/{$icon}@2x.png";
                    $today_forecast[] = [
                        'time' => $time,
                        'temp' => $temp,
                        'humidity' => $humidity,
                        'windSpeed' => $windSpeed,
                        'description' => $description,
                        'iconSrc' => $iconSrc
                    ];
                    $today_count++;
                } elseif ($dt === $tomorrow && $tomorrow_count < 8) {
                    $time = date('H:i', strtotime($item['dt_txt']));
                    $temp = round($item['main']['temp']);
                    $humidity = $item['main']['humidity'];
                    $windSpeed = $item['wind']['speed'];
                    $description = ucfirst($item['weather'][0]['description']);
                    $icon = $item['weather'][0]['icon'];
                    $customIcon = self::getCustomIcon($icon);
                    $iconSrc = $customIcon ? "assets/icons/{$customIcon}" : "https://openweathermap.org/img/wn/{$icon}@2x.png";
                    $tomorrow_forecast[] = [
                        'time' => $time,
                        'temp' => $temp,
                        'humidity' => $humidity,
                        'windSpeed' => $windSpeed,
                        'description' => $description,
                        'iconSrc' => $iconSrc
                    ];
                    $tomorrow_count++;
                }
            }
        }

        // Calculate dynamic temperatures for the graph sections
        $pagi_temps = array_slice($today_forecast, 0, 2);
        $siang_temps = array_slice($today_forecast, 2, 2);
        $sore_temps = array_slice($today_forecast, 4, 2);
        $malam_temps = array_slice($today_forecast, 6, 2);

        $pagi_temp = !empty($pagi_temps) ? round(array_sum(array_column($pagi_temps, 'temp')) / count($pagi_temps)) : 16;
        $siang_temp = !empty($siang_temps) ? round(array_sum(array_column($siang_temps, 'temp')) / count($siang_temps)) : 32;
        $sore_temp = !empty($sore_temps) ? round(array_sum(array_column($sore_temps, 'temp')) / count($sore_temps)) : 28;
        $malam_temp = !empty($malam_temps) ? round(array_sum(array_column($malam_temps, 'temp')) / count($malam_temps)) : 20;

        // Determine icons for Siang and Sore based on temperature
        $siang_icon = $siang_temp > 28 ? 'sunsmall.svg' : 'cloudysunsmall.svg';
        $sore_icon = $sore_temp > 28 ? 'sunsmall.svg' : 'cloudysunsmall.svg';

        // Determine weather card background based on local time
        $weather_bg = 'assets/img/morning.png'; // default
        if ($weather && isset($weather['timezone'])) {
            $utc_time = time();
            $local_time = $utc_time + $weather['timezone'];
            $local_hour = (int) date('H', $local_time);
            if ($local_hour >= 6 && $local_hour <= 11) {
                $weather_bg = 'assets/img/morning.png';
            } elseif ($local_hour >= 18 && $local_hour <= 20) {
                $weather_bg = 'assets/img/dusk.png';
            } else {
                $weather_bg = 'assets/img/night.png';
            }
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
