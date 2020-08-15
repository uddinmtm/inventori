<?php
include_once(__DIR__ . '/../../config.php');
header('Content-Type: application/json');

// get request body
parse_str(file_get_contents("php://input"), $params);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['name'])) {
        echo json_encode(['message' => 'nama required']);
        http_response_code(400);
        die();
    }

    if (empty($_POST['username'])) {
        echo json_encode(['message' => 'username required']);
        http_response_code(400);
        die();
    }

    if (empty($_POST['password'])) {
        echo json_encode(['message' => 'password required']);
        http_response_code(400);
        die();
    }

    if (empty($_POST['level'])) {
        echo json_encode(['message' => 'level required']);
        http_response_code(400);
        die();
    }

    $name       = mysqli_real_escape_string($conn, $_POST['name']);
    $username   = mysqli_real_escape_string($conn, $_POST['username']);
    $password   = mysqli_real_escape_string($conn, $_POST['password']);
    $level      = mysqli_real_escape_string($conn, $_POST['level']);

    $sql = "INSERT INTO m_user (id, name, `level`, username, password, created_by) VALUES ('','{$name}', '{$level}', '{$username}', '{$password}', '{$_SESSION['username']}')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo json_encode(['message' => 'save item failed']);
        http_response_code(400);
        die();
    }

    echo json_encode(['status' => 'success']);
    die();
}

$sql = "SELECT id, name, level, username, password FROM m_user WHERE created_by='{$_SESSION['username']}'";
$results = mysqli_query($conn, $sql);
$rows =  mysqli_fetch_all($results, MYSQLI_ASSOC);
if (empty($rows)) $rows = [];

echo json_encode(['data' => $rows]);
