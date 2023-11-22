<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_nt3102";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the form
$lastname = $_POST['lastname'];
$firstname = $_POST['firstname'];
$department = $_POST['department'];
$username = $_POST['username'];
$password = $_POST['password'];
$usersign = $_POST['usersign'];

// Insert into tbemployee table
$sql = "INSERT INTO tbemployee (lastname, firstname, department) VALUES ('$lastname', '$firstname', '$department')";
$conn->query($sql);

// Retrieve the generated empid
$last_empid = $conn->insert_id;

// Insert into security table with the generated empid
$sql = "INSERT INTO security (username, password, role, usersign, empid) VALUES ('$username', '$password', 'security', '$usersign', '$last_empid')";
if ($conn->query($sql) === TRUE) {
    echo "User registered successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
