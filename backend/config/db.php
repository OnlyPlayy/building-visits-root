<?php
$conn = new mysqli('localhost', 'root', '', 'system_wizyt');
if ($conn->connect_error) die("Błąd połączenia: " . $conn->connect_error);
?>
