<?php
session_start();
include 'db.php'; // Ensure this file establishes a MySQLi connection and assigns it to $conn

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Process donation form submission
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM Donations WHERE id = :id");
  $stmt->execute(['id' => $id]);
  $donation = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donation Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form method="POST" action="update_donation.php">
        <h2>Donation Form</h2>
        <input type="number" name="amount" placeholder="Donation Amount" required value="<?php echo htmlspecialchars($donation['amount']); ?>">
        <textarea name="message" placeholder="Message (optional)"><?php echo htmlspecialchars($donation['message']); ?></textarea>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($donation['id']); ?>">
        <button type="submit">Update</button>
    </form>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
