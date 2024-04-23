<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {
    $targetDir = "C:\\xampp\\htdocs\\phpistrash\\uploads\\"; 
    $targetFile = $targetDir . basename($_FILES["videoFile"]["name"]); 
    $uploadOk = 1;
    $videoFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if (file_exists($targetFile)) {
        echo "<p class='error'>Sorry, file already exists.</p>";
        $uploadOk = 0;
    }

    if ($_FILES["videoFile"]["size"] > 50000000) {
        echo "<p class='error'>Sorry, your file is too large.</p>";
        $uploadOk = 0;
    }

    if($videoFileType != "mp4" && $videoFileType != "avi" && $videoFileType != "mov"
    && $videoFileType != "mpeg" && $videoFileType != "wmv") {
        echo "<p class='error'>Sorry, only MP4, AVI, MOV, MPEG, & WMV files are allowed.</p>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<p class='error'>Sorry, your file was not uploaded.</p>";
    } else {
        if (move_uploaded_file($_FILES["videoFile"]["tmp_name"], $targetFile)) {
            echo "<p class='success'>The file ". htmlspecialchars( basename( $_FILES["videoFile"]["name"])) . " has been uploaded.</p>";
        } else {
            echo "<p class='error'>Sorry, there was an error uploading your file.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <title>Upload Video</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            padding: 20px;
            margin: 0;
        }
        .container {
            background-color: #121212;
            max-width: 500px;
            margin: auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #fff;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }
        .form-group input[type="file"] {
            display: block;
            width: 100%;
            color: #fff;
        }
        .form-group input[type="submit"], .logout-button {
            padding: 10px 20px; 
            background-color: #5e42a6; /* Purple background */
            color: white; 
            text-decoration: none; 
            border: none; 
            cursor: pointer; 
            border-radius: 5px; 
            margin-top: 10px;
        }

        .form-group input:hover, .form-group input:focus{ 
            background-color: #4e2293; /* Darker purple on hover */
            color: white;
        }
        .logout-button {
            background-color: #5e42a6;
            margin-top: 10px;
        }
        .logout-button:hover {
            background-color: #4e2293;
        }
        .error {
            color: #f44336;
            background-color: #ffd2d2;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        .success {
            color: #4CAF50;
            background-color: #d4edda;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload Video</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="videoFile">Choose a video file:</label>
                <input type="file" name="videoFile" id="videoFile" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Upload Video">
            </div>
            <button type="button" onclick="window.location.href='index.php';" class="logout-button">Go Back to Home</button>
        </form>
    </div>
</body>
</html>