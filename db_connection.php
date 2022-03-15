<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "new_project";

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected to database";
} catch(PDOException $e) {
    echo "Connection failes: ".$e->getMessage();
}



?>