<?php
// header('Access-Control-Allow-Origin: *');

// header('Access-Control-Allow-Methods: GET, POST');

// header("Access-Control-Allow-Headers: X-Requested-With");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require __DIR__ . '/vendor/autoload.php';

use App\db;

$conn = db::connect();
$sql = "SELECT * FROM rooms";
$query = $conn->query($sql);
if ($query->num_rows > 0) {
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = array();
}
$conn->close();
echo json_encode($data);
