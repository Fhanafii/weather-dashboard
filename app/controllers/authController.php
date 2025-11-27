<?php
session_start();
include '../config/db.php';

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username']
        ];

        header("Location: /index.php");
        exit();
    } else {
        header("Location: /login.php?error=1");
        exit();
    }
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if username already exists
    $check_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check_query) > 0) {
        header("Location: /login.php?error=2");
        exit();
    }

    // Insert new user
    $insert_query = mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");

    if ($insert_query) {
        header("Location: /login.php?success=1");
        exit();
    } else {
        header("Location: /login.php?error=3");
        exit();
    }
}
