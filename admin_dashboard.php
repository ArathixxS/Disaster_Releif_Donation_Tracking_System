<?php
session_start();
include 'db.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

$stmt = $pdo->query("SELECT Donations.id, Users.username, Donations.amount, Donations.message, Donations.date FROM Donations JOIN Users ON Donations.user_id = Users.id");
$donations = $stmt->fetchAll();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Donations</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Donations List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Amount</th>
            <th>Message</th>
            <th>Date</th>
			<th>Action</th>
        </tr>
        <?php foreach ($donations as $donation): ?>
            <tr>
                <td><?php echo htmlspecialchars($donation['id']); ?></td>
                <td><?php echo htmlspecialchars($donation['username']); ?></td>
                <td><?php echo htmlspecialchars($donation['amount']); ?></td>
                <td><?php echo htmlspecialchars($donation['message']); ?></td>
                <td><?php echo htmlspecialchars($donation['date']); ?></td>
				<td><a href="edit_donation.php?id=<?php echo htmlspecialchars($donation['id']); ?>">Edit</a> &nbsp; <a href="delete_donation.php?id=<?php echo htmlspecialchars($donation['id']); ?>">Delete</a>
        </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="index.php">Back to Home</a></p>
</body>
</html>
