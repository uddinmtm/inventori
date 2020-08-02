<?php
include_once(__DIR__ . '/../../config.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['message' => 'method not allowed']);
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

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = md5($_POST['password']);

$sql = "SELECT * FROM m_user WHERE username='$username'";
$results = mysqli_query($conn, $sql);
if (mysqli_num_rows($results) == 0) {
    echo json_encode(['message' => 'username not found']);
    http_response_code(400);
    die();
}

$user =  mysqli_fetch_assoc($results);
if ($user['password'] !== $password) {
    echo json_encode(['message' => 'wrong password']);
    http_response_code(400);
    die();
}

// set session
$_SESSION["name"] = $user['name'];
$_SESSION["username"] = $user['username'];

echo json_encode("success");
