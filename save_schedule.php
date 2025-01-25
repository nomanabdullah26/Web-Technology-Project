<?php
$jsonFile = 'schedules.json';

$data = json_decode(file_get_contents('php://input'), true);

if (!file_exists($jsonFile)) {
    file_put_contents($jsonFile, json_encode([]));
}

$schedules = json_decode(file_get_contents($jsonFile), true);

$schedules[] = $data;

file_put_contents($jsonFile, json_encode($schedules, JSON_PRETTY_PRINT));

echo json_encode(["success" => true]);
