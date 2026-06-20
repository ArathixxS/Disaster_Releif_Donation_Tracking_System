<?php
// Include database connection
$host = 'localhost';
$dbname = 'disaster_relief_donation';
$username = 'root'; // Change this if necessary
$password = ''; // Change this if necessary

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminUsername = $_POST['username'];
    $adminPassword = $_POST['password'];

    // Prepare and execute the query
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
    $stmt->bindParam(':username', $adminUsername);
    $stmt->execute();

    // Fetch the user
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify password
    if ($admin && password_verify($adminPassword, $admin['password'])) {
        // Login successful, redirect or set session variables
        session_start();
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="button">Login</button>
        </form>
        <p><a href="index.php">Back to Home</a></p>
    </div>
</body>
</html>
