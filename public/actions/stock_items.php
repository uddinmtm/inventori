<?php
include_once(__DIR__ . '/../../config.php');
header('Content-Type: application/json');

// read
$sql = "SELECT id, name as item_name, type as item_type, (SELECT (sum(d.stock_in) - sum(d.stock_out)) FROM t_stock_detail d WHERE d.item_id=m_item.id) AS item_stock FROM m_item ORDER BY name ";

$results = mysqli_query($conn, $sql);
$rows =  mysqli_fetch_all($results, MYSQLI_ASSOC);
if (empty($rows)) $rows = [];

echo json_encode(['data' => $rows]);
