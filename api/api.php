<?php
require __DIR__ . '/vendor/autoload.php';
// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }


use App\auth\Admin;
use App\db;
$conn = db::connect();

// SQL query
$sql = "SELECT * FROM rooms";


// Execute query
// $result = mysqli_query($conn, $sql);
$result = $conn->query($sql);
// var_dump($result);

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Fetch the data as an associative array
    while ($row = $result->fetch_assoc()) {
       $data[] = $row;
    }
    
} else {
    $data = array();
}

// Close the database connection
$conn->close();

// Return the data as JSON
echo json_encode($data);
