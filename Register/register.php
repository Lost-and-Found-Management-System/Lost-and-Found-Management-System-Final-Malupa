<?php
session_start();
require_once('db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare('INSERT INTO users (full_name, username, password, role) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $full_name, $username, $password, $role);

    if ($stmt->execute()) {
        echo "User registered successfully!";
    } else {
        echo "Error during registration: " . $stmt->error;
    }

    $stmt->close();
}
?>