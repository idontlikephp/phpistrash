<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Screen</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #000; color: #fff; }
        .login-container { max-width: 300px; margin: auto; padding-top: 50px; }
        form { display: flex; flex-direction: column; }
        input[type="text"], input[type="password"] { margin-bottom: 10px; padding: 10px; background-color: #222; border: 1px solid #5e42a6; color: #fff; }
        input[type="submit"] { padding: 10px; background-color: #5e42a6; color: white; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #4e2293; }
        a { color: #5e42a6; }
    </style>
</head>
<body>
    <div class="login-container" style="text-align:center; margin-top:20px;">
         Don't have an account? <a href="signup.php">Sign up</a>
        <h2>Login</h2>
        <form action="authenticate.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>