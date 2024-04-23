<?php
session_start();

if (!isset(['username'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Welcome the user
echo "<h1>Welcome " . htmlspecialchars(['username']) . "!</h1>";
echo "<a href='logout.php'>Logout</a>";