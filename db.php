<?php
$host = 'localhost';
$dbname = 'disaster_relief_donation';
$username = 'root'; // Change this if necessary
$password = ''; // Change this if necessary

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>