<?php
// Replace these with your actual database credentials
$host = "your_host";
$dbname = "your_database";
$user = "your_username";
$password = "your_password";

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empid = $_POST["empid"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"];
    $usersign = $_POST["usersign"];
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $department = $_POST["department"];

    // Perform basic validation
    if (empty($empid) || empty($username) || empty($password) || empty($role) || empty($usersign) || empty($lastname) || empty($firstname) || empty($department)) {
        echo "All fields are required.";
        exit();
    }

    // Perform SQL insertion into tbemployee
    $sqlEmployee = "INSERT INTO tbemployee (empid, lastname, firstname, department) VALUES (?, ?, ?, ?)";
    $stmtEmployee = $pdo->prepare($sqlEmployee);
    $stmtEmployee->execute([$empid, $lastname, $firstname, $department]);

    // Perform SQL insertion into security
    $sqlSecurity = "INSERT INTO security (UserId, username, password, role, usersign) VALUES (?, ?, ?, ?, ?)";
    $stmtSecurity = $pdo->prepare($sqlSecurity);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmtSecurity->execute([$empid, $username, $hashedPassword, $role, $usersign]);

    echo "Registration successful!";
}
?>
