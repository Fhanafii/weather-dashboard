<?php
$url = 'https://api.openweathermap.org/data/2.5/weather?q=Jakarta&appid=cfa69a5bf063a35254db32d44f13cea6&units=metric';

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

echo $response ? 'success' : 'fail';
if ($response) {
    echo "\n" . substr($response, 0, 200);
} else {
    echo "\nNo response received";
}
?>
