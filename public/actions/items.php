<?php
include_once(__DIR__ . '/../../config.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['nama'])) {
        echo json_encode(['message' => 'nama required']);
        http_response_code(400);
        die();
    }

    if (empty($_POST['jenis'])) {
        echo json_encode(['message' => 'jenis required']);
        http_response_code(400);
        die();
    }

    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $jenis = mysqli_real_escape_string($conn, $_POST['jenis']);

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

$sql = "SELECT id, name, type FROM m_item WHERE created_by='{$_SESSION['username']}'";
$results = mysqli_query($conn, $sql);
$rows =  mysqli_fetch_all($results, MYSQLI_ASSOC);
if (empty($rows)) $rows = [];

echo json_encode(['data' => $rows]);
