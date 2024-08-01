<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="./css/registration.css">
</head>
<body>
    <div class="register">
    <h2>Register</h2>
    <form action="register_process.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="access_key">Access Key:</label>
            <input type="text" id="access_key" name="access_key" required>
        </div>
        <button type="submit">Register</button>
    </form>
    </div>
</body>
</html>
