<?php
session_start();

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Define the path to the video storage directory
$videoDir = 'C:\xampp\htdocs\phpistrash\uploads\\'; 

// Fetch all video files from the directory
$videos = glob($videoDir . '*.{mp4,avi,mov}', GLOB_BRACE); // Adjust file extensions as needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #000; /* Black background */
            color: #fff; /* White text color */
            margin: 0; 
            padding: 20px; 
        }
        .content-container { 
            max-width: 800px; 
            margin: auto; 
            padding: 20px; 
            background-color: #121212; /* Darker shade for the container */
            border: 1px solid #5e42a6; /* Purple border */
            box-shadow: 0 2px 4px rgba(94, 66, 166, 0.5); /* Purple shadow */
            border-radius: 8px; 
        }
        .logout-button { 
            padding: 10px 20px; 
            background-color: #5e42a6; /* Purple background */
            color: white; 
            text-decoration: none; 
            border: none; 
            cursor: pointer; 
            border-radius: 5px; 
            margin-top: 10px;
        }
        .logout-button:hover { 
            background-color: #4e2293; /* Darker purple on hover */
        }
        video { 
            max-width: 100%; 
            height: auto; 
            margin: 20px auto; 
            display: block; 
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); 
            padding: 10px; 
            background-color: #fff; 
            border-radius: 10px; 
            border: 2px solid #ddd; 
        }
        .top-bar { 
            display: flex; 
            align-items: center; 
            justify-content: space-between; 
        }
        .welcome-message { 
            flex-grow: 1; 
            color: #5e42a6; /* Purple text color for welcome message */
        }
    </style>
</head>
<body>
    <div class="content-container">
        <div class="top-bar">
            <h1 class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
            <button onclick="location.href='upload_video.php'" class="logout-button">Upload Video</button>
            <button onclick="location.href='logout.php'" class="logout-button">Logout</button>
        </div>
        <p>This is the content of your application. Only logged-in users can see this.</p>
        <!-- Display videos here -->
        <?php foreach ($videos as $videoPath): ?>
            <video controls>
                <source src="<?php echo htmlspecialchars(str_replace($videoDir, 'http://localhost/phpistrash/uploads/', $videoPath)); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <form action="delete_video.php" method="post">
                <input type="hidden" name="videoPath" value="<?php echo htmlspecialchars($videoPath); ?>">
                <input type="submit" name="delete" value="Delete Video" class="logout-button" onclick="return confirm('Are you sure you want to delete this video?');">
            </form>
        <?php endforeach; ?>
        <?php if (empty($videos)): ?>
            <p>No videos found.</p>
        <?php endif; ?>
    </div>
</body>
</html>