<?php
include_once(__DIR__ . '/../../config.php');
header('Content-Type: application/json');

// get request body
parse_str(file_get_contents("php://input"), $params);

// add
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($params['name'])) {
        echo json_encode(['message' => 'nama required']);
        http_response_code(400);
        die();
    }

    if (empty($params['username'])) {
        echo json_encode(['message' => 'username required']);
        http_response_code(400);
        die();
    }

    if (empty($params['password'])) {
        echo json_encode(['message' => 'password required']);
        http_response_code(400);
        die();
    }

    if (empty($params['level'])) {
        echo json_encode(['message' => 'level required']);
        http_response_code(400);
        die();
    }

    $name       = mysqli_real_escape_string($conn, $params['name']);
    $username   = mysqli_real_escape_string($conn, $params['username']);
    $password   = mysqli_real_escape_string($conn, $params['password']);
    $level      = mysqli_real_escape_string($conn, $params['level']);

    $sql = "INSERT INTO m_user (name, level, username, password, created_by) VALUES ('{$name}', '{$level}', '{$username}', '{$password}', '{$_SESSION['username']}')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo json_encode(['message' => 'save item failed']);
        http_response_code(400);
        die();
    }

    echo json_encode(['status' => 'success']);
    die();
}

// update 
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    if (empty($params['id'])) {
        echo json_encode(['message' => 'id required']);
        http_response_code(400);
        die();
    }

    if (empty($params['name'])) {
        echo json_encode(['message' => 'nama required']);
        http_response_code(400);
        die();
    }

    if (empty($params['username'])) {
        echo json_encode(['message' => 'username required']);
        http_response_code(400);
        die();
    }

    if (empty($params['password'])) {
        echo json_encode(['message' => 'password required']);
        http_response_code(400);
        die();
    }

    if (empty($params['level'])) {
        echo json_encode(['message' => 'level required']);
        http_response_code(400);
        die();
    }

    $id         = mysqli_real_escape_string($conn, $params['id']);
    $name       = mysqli_real_escape_string($conn, $params['name']);
    $username   = mysqli_real_escape_string($conn, $params['username']);
    $password   = mysqli_real_escape_string($conn, $params['password']);
    $level      = mysqli_real_escape_string($conn, $params['level']);

    $sql = "UPDATE m_user SET name='{$name}', level='{$level}', username='{$username}', password='{$password}', updated_by='{$_SESSION['username']}' WHERE id={$id}";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo json_encode(['message' => 'update item failed']);
        http_response_code(400);
        die();
    }

    echo json_encode(['status' => 'success']);
    die();
}

// delete
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (empty($_REQUEST['id'])) {
        echo json_encode(['message' => 'id required']);
        http_response_code(400);
        die();
    }

    $id = mysqli_real_escape_string($conn, $_REQUEST['id']);
    $sql = "DELETE FROM m_user WHERE id={$id}";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo json_encode(['message' => 'delete item failed']);
        http_response_code(400);
        die();
    }

    echo json_encode(['status' => 'success']);
    die();
}

// read
$sql = "SELECT id, name, level, username, password FROM m_user WHERE created_by='{$_SESSION['username']}'";
if (!empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql.= "AND id={$id}";

}
$results = mysqli_query($conn, $sql);
$rows =  mysqli_fetch_all($results, MYSQLI_ASSOC);
if (empty($rows)) $rows = [];

echo json_encode(['data' => $rows]);
