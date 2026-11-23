<?php
require_once __DIR__ . '/config.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');

$stmt = $pdo->query(
    'SELECT bpm, created_at
     FROM heartbeat_readings
     ORDER BY id DESC
     LIMIT 1'
);

echo json_encode($stmt->fetch() ?: [
    'bpm' => null,
    'created_at' => null
]);
