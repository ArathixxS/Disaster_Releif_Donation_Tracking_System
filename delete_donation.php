<?php
session_start();
include 'db.php'; // Ensure this file establishes a MySQLi connection and assigns it to $conn

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Get the donation ID from the query parameter and delete the record
$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM Donations WHERE id = :id");
$stmt->bindValue(":id", $id);

if ($stmt->execute()) {
    header('Location: admin_dashboard.php');
    exit;
} else {
    echo "Error deleting record: " . $stmt->error;
}

?>