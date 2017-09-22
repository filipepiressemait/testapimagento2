<?php
include './config.php';

if (!USERNAME || !PASSWORD || !URL) return;
$data = ["username" => USERNAME, "password" => PASSWORD];
$data_string = json_encode($data);

$ch = curl_init(URL . PARAMS1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
);

$token = curl_exec($ch);
$token_string = json_decode($token);
$header = ["Content-Type: application/json", "Authorization:Bearer " . $token_string];

$ch = curl_init(URL . PARAMS2);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

$result = curl_exec($ch);

header("Content-type:application/json");
echo $result;