<?php
include_once(__DIR__ . '/../../config.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['message' => 'method not allowed']);
    http_response_code(400);
    die();
}

if (empty($_POST['sandi_lama'])) {
    echo json_encode(['message' => 'sandi_lama required']);
    http_response_code(400);
    die();
}

if (empty($_POST['sandi_baru'])) {
    echo json_encode(['message' => 'sandi_baru required']);
    http_response_code(400);
    die();
}

$username = mysqli_real_escape_string($conn, $_SESSION['username']);
$sandi_lama = mysqli_real_escape_string($conn, $_POST['sandi_lama']);
$sandi_baru = mysqli_real_escape_string($conn, $_POST['sandi_baru']);

$sql = "SELECT * FROM m_user WHERE username='{$username}' AND password=MD5('{$sandi_lama}')";
$results = mysqli_query($conn, $sql);
if (mysqli_num_rows($results) == 0) {
    echo json_encode(['message' => 'sandi_lama not correct']);
    http_response_code(400);
    die();
}

$sql = "UPDATE m_user SET password=MD5('{$sandi_baru}'), updated_by='{$username}' WHERE password=MD5('{$sandi_lama}') AND username='{$username}'";
$results = mysqli_query($conn, $sql);

echo json_encode("success");
