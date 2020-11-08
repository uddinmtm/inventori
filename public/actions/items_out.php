<?php
include_once(__DIR__ . '/../../config.php');
header('Content-Type: application/json');

// get request body
parse_str(file_get_contents("php://input"), $params);

// add 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($params['nomor'])) {
        echo json_encode(['message' => 'nomor required']);
        http_response_code(400);
        die();
    }

    if (empty($params['tanggal'])) {
        echo json_encode(['message' => 'tanggal required']);
        http_response_code(400);
        die();
    }

    $nomor = mysqli_real_escape_string($conn, $params['nomor']);
    $keterangan = mysqli_real_escape_string($conn, $params['keterangan']);
    $tanggal = mysqli_real_escape_string($conn, $params['tanggal']);
    $items = json_decode($params['daftar_barang']);

    // validate nomor
    $sql = "SELECT * FROM t_stock WHERE transaction_code='{$nomor}'";
    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results) > 0) {
        echo json_encode(['message' => 'nomor not available']);
        http_response_code(400);
        die();
    }

    // insert detail
    foreach ($items as $item) {
        $sql = "INSERT INTO t_stock_detail (transaction_code, item_id, stock_in, stock_out, created_at) VALUES ('{$nomor}', {$item->id}, 0, {$item->qty}, current_timestamp())";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo json_encode(['message' => 'save item failed']);
            http_response_code(400);
            die();
        }
    }

    $sql = "INSERT INTO t_stock (transaction_code, transaction_date, description, status, created_at, created_by) VALUES('{$nomor}', '{$tanggal}', '{$keterangan}', 'OUT', current_timestamp(), '{$_SESSION['username']}')";

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

    if (empty($params['nomor'])) {
        echo json_encode(['message' => 'nomor required']);
        http_response_code(400);
        die();
    }

    if (empty($params['tanggal'])) {
        echo json_encode(['message' => 'tanggal required']);
        http_response_code(400);
        die();
    }

    $id = mysqli_real_escape_string($conn, $params['id']);
    $nomor = mysqli_real_escape_string($conn, $params['nomor']);
    $keterangan = mysqli_real_escape_string($conn, $params['keterangan']);
    $tanggal = mysqli_real_escape_string($conn, $params['tanggal']);
    $items = json_decode($params['daftar_barang']);

    // delete previous detail
    $sql = "DELETE FROM t_stock_detail WHERE transaction_code='{$id}'";
    $result = mysqli_query($conn, $sql);

    // insert detail
    foreach ($items as $item) {
        $sql = "INSERT INTO t_stock_detail (transaction_code, item_id, stock_in, stock_out, created_at) VALUES ('{$nomor}', {$item->id}, 0, {$item->qty}, current_timestamp())";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo json_encode(['message' => 'save item failed']);
            http_response_code(400);
            die();
        }
    }

    $sql = "UPDATE t_stock SET transaction_date='{$tanggal}', description='{$keterangan}', updated_at=current_timestamp(), updated_by='{$_SESSION['username']}' WHERE transaction_code='{$id}'";
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
    $sql = "DELETE FROM t_stock_detail WHERE transaction_code='{$id}'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo json_encode(['message' => 'delete item failed']);
        http_response_code(400);
        die();
    }

    $sql = "DELETE FROM t_stock WHERE transaction_code='{$id}'";
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
$sql = "SELECT * FROM t_stock WHERE status='OUT' AND created_by='{$_SESSION['username']}' ";
if (!empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql.= "AND transaction_code='{$id}'";
}

$results = mysqli_query($conn, $sql);
$rows = [];
if (!empty($results)) {
    $rows = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

if (!empty($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT d.*, m.name FROM t_stock_detail d LEFT JOIN m_item m ON d.item_id=m.id WHERE transaction_code='{$id}'";
    $results = mysqli_query($conn, $sql);
    $subRows =  mysqli_fetch_all($results, MYSQLI_ASSOC);
    if (empty($subRows)) $subRows = [];

    $rows[0]['detail'] = $subRows;
}

echo json_encode(['data' => $rows]);
