<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include('../config/db.php');

// Sprawdź połączenie z bazą
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT id, name, email, phone, address, service_type, visit_date FROM visits ORDER BY visit_date ASC");
$visits = [];

while ($row = $result->fetch_assoc()) {
    // Konwertuj datę na format ISO 8601
    $visit_date = date('Y-m-d\TH:i:s', strtotime($row['visit_date']));
    $visits[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'email' => $row['email'],
        'phone' => $row['phone'],
        'address' => $row['address'],
        'service_type' => $row['service_type'],
        'visit_date' => $visit_date, // Zmieniona data na format ISO 8601
    ];
}

header('Content-Type: application/json'); 
echo json_encode($visits);

$conn->close();
?>
