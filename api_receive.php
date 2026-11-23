<?php
require_once __DIR__ . '/config.php';

header('Content-Type: application/json; charset=utf-8');

$apiKey = 'CHANGE_THIS_TO_A_LONG_RANDOM_SECRET';
$receivedKey = $_SERVER['HTTP_X_API_KEY'] ?? '';

if (!hash_equals($apiKey, $receivedKey)) {
    http_response_code(401);
    exit(json_encode(['success' => false, 'error' => 'Unauthorized']));
}

$data = json_decode(file_get_contents('php://input'), true);
$bpm = filter_var($data['bpm'] ?? null, FILTER_VALIDATE_INT);

if ($bpm === false || $bpm === null || $bpm < 1 || $bpm > 250) {
    http_response_code(400);
    exit(json_encode(['success' => false, 'error' => 'Invalid BPM']));
}

$stmt = $pdo->prepare(
    'INSERT INTO heartbeat_readings (bpm) VALUES (?)'
);
$stmt->execute([$bpm]);

echo json_encode(['success' => true, 'bpm' => $bpm]);
