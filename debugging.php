<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    include 'db_connect.php';

    // Prepare the SQL statement
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Add debug statements
    echo "Username entered: $usernamess<br>";
    echo "Password entered: $passwordss<br>";
    echo "Number of rows found: " . $stmt->num_rows . "<br>";
    echo "Hashed password from DB: $hashed_password<br>";

    if ($stmt->num_rows > 0) {
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            header('Location: dashboard.php');
            exit();
        } else {
            echo "Password verification failed.<br>";
        }
    } else {
        echo "Username not found.<br>";
    }

    $stmt->close();
    $conn->close();
}

