<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['delete']) && !empty($_POST['videoPath'])) {
    $videoPath = $_POST['videoPath'];
    // Security check to ensure the file to be deleted is indeed a video file within the uploads directory
    if (strpos($videoPath, 'C:\\xampp\\htdocs\\phpistrash\\uploads\\') === 0 && file_exists($videoPath)) {
        unlink($videoPath); // Delete the video file
        $_SESSION['message'] = "Video deleted successfully.";
    } else {
        $_SESSION['error'] = "Error deleting the video.";
    }
}

header("Location: index.php"); // Redirect back to the index page
exit;
?>