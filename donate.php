<?php
session_start();
include 'db.php'; // Ensure this file establishes a MySQLi connection and assigns it to $conn

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit;
}

// Process donation form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $amount = $_POST['amount'];
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    // Prepare and execute the insert statement
    $sql = "INSERT INTO Donations (user_id, amount, message) VALUES (:user_id, :amount, :message)";
	$stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':message', $message);
	$stmt->bindValue(':amount', $amount);
    if ($stmt->execute()) {
        echo "Thank you for donating!";
    } else {
        echo "Error: " . $stmt->error;
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donation Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form method="POST">
        <h2>Donation Form</h2>
        <input type="number" name="amount" placeholder="Donation Amount" required>
        <textarea name="message" placeholder="Message (optional)"></textarea>
        <button type="submit">Submit</button>
    </form>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
