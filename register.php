<?php
// Database connection variables
$host = 'localhost'; // or your host
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'user_db';

// Create connection
$conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Assuming you're getting these from a form submission
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prevent SQL injection
$username = $conn->real_escape_string($username);
$email = $conn->real_escape_string($email);
$hashedPassword = $conn->real_escape_string($hashedPassword);

// Insert the new user into the database
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    // Redirect to login page
    header("Location: login.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>