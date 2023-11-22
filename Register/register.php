<?php
// Replace these with your actual database credentials
$host = "localhost";
$dbname = "db_nt3102";
$user = "root";
$password = "";

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $usersign = $_POST["usersign"];

    // Perform basic validation
    if (empty($username) || empty($password) || empty($role) || empty($usersign)) {
        echo "All fields are required.";
        exit();
    }

    // Perform SQL insertion
    $sql = "INSERT INTO security (username, password, role, usersign) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt->execute([$username, $hashedPassword, $role, $usersign]);

    echo "Registration successful!";
}
?>
