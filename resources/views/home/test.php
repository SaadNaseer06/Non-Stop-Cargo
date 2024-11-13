<?php

$apiKey = 'UXIT6~py58oeefs5BF2eqHR4ws';
$requestId = 'test123';
$input = 'Delhi';

$url = "https://api.olamaps.io/places/v1/textsearch?input=" . urlencode($input) . "&api_key=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Disable SSL verification (not recommended for production)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Add header for request ID
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "X-Request-Id: $requestId"
]);

$response = curl_exec($ch);

if(curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo "HTTP Code: " . $http_code . "<br>";
    echo "<pre>";
    print_r(json_decode($response, true));
    echo "</pre>";
}

curl_close($ch);
