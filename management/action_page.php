<?php
session_start();

include "../config.php";

if ($conn->connect_error) {
    die("Database connection failed.");
}

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $username;
    header("Location: admin/index.php");
    exit();
} else {
    header("Location: index.php?error=invalid_login");
    exit();
}
?>