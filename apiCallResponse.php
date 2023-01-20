<?php

require 'validateToken.php';

header('Content-Type:application/json');

//the endpoint that you want to consume
$url = "";

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_URL => $url,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer ".$token['token'],
    ),
]);

$response = curl_exec($curl);
curl_close($curl);

$ntfs = str_replace('\\', '', $response);

$array = json_decode($ntfs);

$newArray = [];

//iterating API response
foreach ($array->records as $value) {
    $newArray[] = [
        //...
    ];
}

echo json_encode($newArray);
