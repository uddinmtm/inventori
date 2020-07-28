<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['message' => 'method not allowed']);
    http_response_code(400);
    die();
}

session_destroy();

echo json_encode("success");
