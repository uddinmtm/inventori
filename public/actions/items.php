<?php
include_once(__DIR__ . '/../../config.php');
header('Content-Type: application/json');

// get request body
parse_str(file_get_contents("php://input"), $params);

// add 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($params['nama'])) {
        echo json_encode(['message' => 'nama required']);
        http_response_code(400);
        die();
    }

    if (empty($params['jenis'])) {
        echo json_encode(['message' => 'jenis required']);
        http_response_code(400);
        die();
    }

    $nama = mysqli_real_escape_string($conn, $params['nama']);
    $jenis = mysqli_real_escape_string($conn, $params['jenis']);

    $sql = "INSERT INTO m_item (name, `type`, created_by) VALUES ('{$nama}', '{$jenis}', '{$_SESSION['username']}')";
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

    if (empty($params['nama'])) {
        echo json_encode(['message' => 'nama required']);
        http_response_code(400);
        die();
    }

    if (empty($params['jenis'])) {
        echo json_encode(['message' => 'jenis required']);
        http_response_code(400);
        die();
    }

    $id = mysqli_real_escape_string($conn, $params['id']);
    $nama = mysqli_real_escape_string($conn, $params['nama']);
    $jenis = mysqli_real_escape_string($conn, $params['jenis']);

    $sql = "UPDATE m_item SET name='{$nama}', `type`='{$jenis}', updated_by='{$_SESSION['username']}' WHERE id={$id}";
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
    $sql = "DELETE FROM m_item WHERE id={$id}";
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
$sql = "SELECT id, name, type FROM m_item WHERE created_by='{$_SESSION['username']}' ";
if (!empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql.= "AND id={$id}";
}

$results = mysqli_query($conn, $sql);
$rows =  mysqli_fetch_all($results, MYSQLI_ASSOC);
if (empty($rows)) $rows = [];

echo json_encode(['data' => $rows]);
