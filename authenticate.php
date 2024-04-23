<?php
session_start();

// Database connection variables
$host = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'user_db';

// Create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Prevent SQL injection
$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

// Query the database for user
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

$loginSuccess = false; // Flag to track login success

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Authentication success
        $_SESSION['username'] = $username;
        $loginSuccess = true;
        header("Location: index.php");
    }
}

// Log the attempt
$logSql = "INSERT INTO login_attempts (username, success) VALUES (?, ?)";
$stmt = $conn->prepare($logSql);
$stmt->bind_param("si", $username, $loginSuccess);
$stmt->execute();
$stmt->close();

if (!$loginSuccess) {
    // Authentication failed
    echo "Invalid username or password. <a href='login.php'>Try again</a>";
}

$conn->close();
?>